<?php

namespace App\Http\Controllers;

use App\Models\Order;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);
        $html = view('invoices.invoice', compact('order'))->render();

        return PdfKh::loadHtml($html)
            ->download('invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
    public function stream(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);
        $html = view('invoices.invoice', compact('order'))->render();

        // The local config has been REMOVED.

        return PdfKh::loadHtml($html)
            ->stream('invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function save(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);
        $html = view('invoices.invoice', compact('order'))->render();
        $filename = 'invoices/invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf';

        // The local config has been REMOVED.

        $path = PdfKh::loadHtml($html)
            ->save($filename, 'public');

        return response()->json([
            'success' => true,
            'pdf_url' => asset('storage/' . $path)
        ]);
    }
}
