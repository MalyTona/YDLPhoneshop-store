<!DOCTYPE html>
<html lang="km">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice - INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} - YDLPhoneshop</title>
    <style>
        /* Base font is Roboto for English text, numbers, and symbols */
        body {
            font-family: 'roboto', sans-serif;
            text-align: center;
            color: #555;
            font-size: 14px;
            margin: 0;
            background-color: #f5f5f5;
        }

        /* Class ONLY for Khmer script */
        .khmer-font {
            font-family: 'battambang', 'khmermuol', sans-serif;
        }

        /* Class ONLY for the main Khmer company name */
        .company-name-khmer {
            font-family: 'khmermuol', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            line-height: 1.6;
            background-color: white;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .top-info td:last-child {
            text-align: right;
        }

        .billing-info td {
            padding-bottom: 30px;
        }

        .heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            padding: 10px 5px;
        }

        .item td {
            border-bottom: 1px solid #eee;
            padding: 10px 5px;
        }

        .item.last td {
            border-bottom: none;
        }

        .totals-table {
            width: auto;
            margin-left: auto;
            text-align: right;
        }

        .totals-table td {
            padding: 4px 5px;
        }

        .totals-table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            color: #155724;
            background-color: #d4edda;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top-info">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                @php
                                    try {
                                        $logoPath = public_path('images/ydllogo.png');
                                        if (file_exists($logoPath)) {
                                            $logoData = base64_encode(file_get_contents($logoPath));
                                            echo '<img src="data:image/png;base64,' . $logoData . '" alt="YDL Logo" style="width: 100%; max-width: 180px;" />';
                                        }
                                    } catch (Exception $e) { /* Do nothing */
                                    }
                                @endphp
                                <div class="company-name-khmer" style="font-size: 32px; color: #4a90e2;">យ៉ត ដាឡែន</div>
                                <div>YDL Phone Shop</div>
                            </td>
                            <td style="width: 40%;">
                                <h2 style="margin-bottom: 20px; color: #333;"><span class="khmer-font">វិក្កយបត្រ</span>
                                    / INVOICE</h2>
                                <strong><span class="khmer-font">លេខវិក្កយបត្រ</span> / Invoice #:</strong>
                                INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br />
                                <strong><span class="khmer-font">កាលបរិច្ឆេទ</span> / Created:</strong>
                                {{ $order->created_at->format('d M, Y') }}<br />
                                <strong><span class="khmer-font">ស្ថានភាព</span> / Status:</strong> <span
                                    class="status-badge">{{ ucfirst($order->status) }}</span><br />
                                <strong><span class="khmer-font">វិធីសាស្រ្តបង់លុយ</span> / Methods:</strong>
                                <span class="status-badge">{{ ucfirst($order->payment_method) }}</span><br />
                                <strong><span class="khmer-font">ស្ថានភាពបង់លុយ</span> / Status:</strong> <span
                                    class="status-badge">{{ ucfirst($order->payment_status) }}</span><br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="billing-info">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <strong><span class="khmer-font">ពី</span> / From:</strong><br />
                                <strong>YDLPhoneshop</strong><br />
                                <span class="khmer-font">ឃុំស្រឡប់ ស្រុកត្បូងឃ្មុំ</span><br />
                                <span class="khmer-font">ខេត្តត្បូងឃ្មុំ, ប្រទេសកម្ពុជា</span><br />
                                +855 71 600 8881 / +855 96 684 4498
                            </td>
                            <td style="width: 50%; text-align: right;">
                                <strong class="khmer-font">ទៅ​កាន់ /</strong> <strong>Bill To:</strong><br />

                                <strong>{{ $order->address->full_name }}</strong><br />
                                <span>{{ $order->address->street_address }}</span><br />
                                <span>{{ $order->address->city }}, {{ $order->address->province }}</span><br />

                                <strong class="khmer-font">ទូរស័ព្ទ /</strong> <strong>Phone:</strong>
                                {{ $order->address->phone }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td style="width: 70%;"><span class="khmer-font">ផលិតផល</span> / Product</td>
                <td style="text-align:right;"><span class="khmer-font">តម្លៃ</span> / Price</td>
            </tr>

            @foreach ($order->items as $item)
                <tr class="item{{ $loop->last ? ' last' : '' }}">
                    <td>
                        <span class="khmer-font">{{ $item->product->name }}</span>
                        <br>
                        <small>Qty: {{ $item->quantity }}</small>
                    </td>
                    <td style="text-align:right;">${{ number_format($item->quantity * $item->unit_amount, 2) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" style="padding: 10px 0;">
                    <table class="totals-table">
                        <tr>
                            <td><span class="khmer-font">សរុបរង</span> / Subtotal:</td>
                            <td>${{ number_format($order->grand_total - $order->shipping_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td><span class="khmer-font">ការដឹកជញ្ជូន</span> / Shipping:</td>
                            <td>${{ number_format($order->shipping_amount, 2) }}</td>
                        </tr>
                        <tr class="total">
                            <td><strong><span class="khmer-font">សរុប</span> / Total:</strong></td>
                            <td><strong>${{ number_format($order->grand_total, 2) }}</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="footer">
            <div class="khmer-font" style="font-weight: bold; font-size: 16px; color: #333; margin-bottom: 10px;">
                អរគុណសម្រាប់ការទិញរបស់អ្នក!
            </div>
            <div class="khmer-font">វិក្កយបត្រនេះត្រូវបានបង្កើតដោយស្វ័យប្រវត្តិ។</div>
            <div>This invoice was generated automatically on {{ now()->format('d M, Y H:i:s') }}.</div>
        </div>
    </div>
</body>

</html>