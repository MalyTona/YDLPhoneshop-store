<?php

namespace App\Livewire;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;



#[Title('Order Detail')]
class MyOrderDetailPage extends Component
{
    public Order $order;
    public $subtotal;
    public $grand_total;

    public function mount($order_id)
    {
        // Find the order for the current user and load all related data at once.
        $this->order = Order::with(['address', 'items.product'])
            ->where('user_id', Auth::id())
            ->where('id', $order_id)
            ->firstOrFail();

        // --- FIX: Calculate subtotal from the actual order items ---
        $subtotal = 0;
        foreach ($this->order->items as $item) {
            $subtotal += $item->unit_amount * $item->quantity;
        }

        $this->subtotal = $subtotal;
        $this->grand_total = $this->order->grand_total;
    }
    public function downloadInvoice()
    {
        // Ensure the user is authorized to download this invoice
        if ($this->order->user_id !== auth()->id()) {
            abort(403);
        }

        $data = ['order' => $this->order];

        // Load the view and generate the PDF
        $pdf = FacadePdf::loadView('invoices.invoice', $data);

        // Download the PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'invoice-' . $this->order->id . '.pdf');
    }
    public function render()
    {
        // Pass the loaded data to the view
        return view('livewire.my-order-detail-page', [
            'order' => $this->order,
            'order_items' => $this->order->items,
            'address' => $this->order->address,
        ]);
    }
}
