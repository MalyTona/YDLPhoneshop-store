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


        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
            'default_font' => 'battambang',
        ];

        // Generate and download PDF
        return PdfKh::loadHtml($html)
            ->addMPdfConfig($config)
            ->download('invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function stream(Order $order)
    {
        // Alternative method to view PDF in browser
        $order->load(['user', 'items.product', 'address']);
        $html = view('invoices.invoice', compact('order'))->render();

        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'battambang',
        ];

        return PdfKh::loadHtml($html)
            ->addMPdfConfig($config)
            ->stream('invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function save(Order $order)
    {
        // Method to save PDF to storage
        $order->load(['user', 'items.product', 'address']);
        $html = view('invoices.invoice', compact('order'))->render();

        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'battambang',
        ];

        $filename = 'invoices/invoice-INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf';

        $path = PdfKh::loadHtml($html)
            ->addMPdfConfig($config)
            ->save($filename, 'public');

        return response()->json([
            'success' => true,
            'pdf_url' => asset('storage/' . $path)
        ]);
    }
}
