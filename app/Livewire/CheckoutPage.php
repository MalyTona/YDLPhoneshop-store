<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderToOwner;
use Illuminate\Support\Facades\Notification;

#[Title('Checkout')]
class CheckoutPage extends Component
{

    public $first_name;
    public $last_name;
    public $phone;
    public $province;
    public $street_address;
    public $payment_method;
    public $shipping_method;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/products');
        }

        if (Auth::check()) {
            $user = Auth::user();
            $name_parts = explode(' ', $user->name, 2);

            $this->first_name = $name_parts[0];
            $this->last_name = $name_parts[1] ?? '';
            // $this->phone = $user->phone;
        }
    }
    public function placeOrder()
    {

        $this->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 'required',
            'province' => 'required|string',
            'street_address' => 'required|string|max:255',
            'payment_method' => 'required',
            'shipping_method' => 'required',

        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name']
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $shipping_cost = 1.50;


        $line_items[] = [
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $shipping_cost * 100,
                'product_data' => [
                    'name' => 'Shipping Fee',
                ],
            ],
            'quantity' => 1,
        ];

        //Calculate the correct grand total. 
        $subtotal = CartManagement::calculateSubtotal($cart_items);
        $grand_total = $subtotal + $shipping_cost;


        $order = new Order();
        $order->user_id = Auth::id();
        // FIX: Add shipping_amount to the grand_total
        $order->grand_total = $grand_total;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'usd';
        $order->shipping_amount = $shipping_cost;
        $order->shipping_method = $this->shipping_method;
        $order->notes = 'Order placed by ' . Auth::user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->province = $this->province;
        $address->street_address = $this->street_address;

        $redirect_url = '';

        if ($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => Auth::user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);
        CartManagement::clearCartItems();
        Mail::to(request()->user())->send(new OrderPlaced($order));
        // ** START: SEND TELEGRAM NOTIFICATION TO SHOP OWNER **
        try {
            $ownerChatId = env('TELEGRAM_CHAT_ID');
            if ($ownerChatId) {
                Notification::route('telegram', $ownerChatId)
                    ->notify(new NewOrderToOwner($order));
            }
        } catch (\Exception $e) {

            logger()->error('TELEGRAM NOTIFICATION FAILED: ' . $e->getMessage());
        }
        // ** END: SEND TELEGRAM NOTIFICATION **
        return redirect($redirect_url);
    }
    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
