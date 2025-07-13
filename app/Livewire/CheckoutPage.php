<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $province;
    public $street_address;
    public $payment_method;

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 'required|string|regex:/^[0-9]{8,15}$/',
            'province' => 'required|string',
            'street_address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:cash,credit_card,bank_transfer', // adjust values to your case
        ]);
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
