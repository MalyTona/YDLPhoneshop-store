<?php

namespace App\Livewire;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

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
        try {
            // Ensure the user is authorized to download this invoice
            if ($this->order->user_id !== auth::id()) {
                abort(403);
            }

            // Load the necessary relationships for the invoice
            $this->order->load(['user', 'items.product', 'address']);

            // Generate HTML from the view
            $html = view('invoices.invoice', ['order' => $this->order])->render();

            // Configure mPDF settings for Khmer support
            $config = [
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_top' => 15,
                'margin_bottom' => 15,
                'margin_left' => 15,
                'margin_right' => 15,
                'default_font' => 'khmeros',
                'default_font_size' => 12,
                'useSubstitutions' => true,
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'allow_charset_conversion' => true,
            ];

            // Generate and download PDF
            return PdfKh::loadHtml($html)
                ->addMPdfConfig($config)
                ->download('invoice-INV-' . str_pad($this->order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('PDF Generation Error: ' . $e->getMessage());

            // Show user-friendly error message
            session()->flash('error', 'Unable to generate invoice. Please try again later.');

            // Optionally redirect back or handle error gracefully
            return redirect()->back();
        }
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
