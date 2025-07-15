<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('Success - YDLPhoneshop')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;



    public function render()
    {
        
        $latest_order = Order::with(['address', 'items.product']) 
                            ->where('user_id', auth()->id()) 
                            ->latest()
                            ->first();

        if($this->session_id){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if ($session_info->payment_status != 'paid') {
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect()->route('cancel');
            } else if ($session_info->payment_status == 'paid') {
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            }
        }

        $subtotal = 0;
        if ($latest_order && $latest_order->items) {
            foreach ($latest_order->items as $item) {
                
                $subtotal += $item->unit_amount * $item->quantity;
            }
        }
        
       
        return view('livewire.success-page', [
            'order' => $latest_order,
            'subtotal' => $subtotal, 
        ]);
    }
}