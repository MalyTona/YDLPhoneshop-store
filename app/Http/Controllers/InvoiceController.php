<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        // Load the necessary relationships for the invoice
        $order->load(['user', 'items.product', 'address']);

        // Set DomPDF options
        $options = [
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ];

        // Pass data to the new view and load it into PDF
        $pdf = Pdf::loadView('invoices.invoice', compact('order'))->setOptions($options);

        // Return a downloadable PDF
        return $pdf->download('invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}
