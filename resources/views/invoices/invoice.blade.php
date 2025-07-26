<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice - INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} - YDLPhoneshop</title>
    <style>
        body {
            font-family: 'battambang', 'khmeros', 'Helvetica Neue', Arial, sans-serif;
            text-align: center;
            color: #777;
            margin: 0;
            /* MODIFIED: Changed padding to 1.5cm for a standard document margin */
            padding: 1.5cm;
            background-color: #f5f5f5;
        }

        body h1 {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            /* MODIFIED: Changed line-height to 1.5 for better readability */
            line-height: 1.5;
            font-family: 'battambang', 'khmeros', 'Helvetica Neue', Arial, sans-serif;
            color: #555;
            background-color: white;
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

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .company-logo {
            width: 80px;
            height: 80px;
            border: 3px solid #4a90e2;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            font-size: 24px;
            font-weight: bold;
            color: #ff8c00;
            margin-bottom: 10px;
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
        }

        .company-name-main {
            font-family: 'khmermuol', 'battambang', 'khmeros', Arial, sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #4a90e2;
            margin: 5px 0;
        }

        .company-name-english {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            padding: 10px 5px;
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            padding: 8px 5px;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
        }

        .khmer-text {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
        }

        .contact-info {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
        }

        .phone-number {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #d4edda;
            color: #155724;
        }

        .invoice-title {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .section-title {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-weight: bold;
        }

        .thank-you-title {
            font-family: 'battambang', 'khmeros', Arial, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                @php
                                    try {
                                        $logoPath = public_path('images/ydllogo.png');
                                        if (file_exists($logoPath)) {
                                            $logoData = base64_encode(file_get_contents($logoPath));
                                            echo '<img src="data:image/png;base64,' . $logoData . '" alt="YDL Logo" style="width: 100%; max-width: 200px" />';
                                        } else {
                                            echo '<div class="company-logo">YDL</div>';
                                        }
                                    } catch (Exception $e) {
                                        echo '<div class="company-logo">YDL</div>';
                                    }
                                @endphp
                                <div class="company-name-main">យ៉ត ដាឡែន</div>
                                <div class="company-name-english khmer-text">YDL Phone Shop</div>
                            </td>
                            <td>
                                <div class="invoice-title khmer-text">វិក្កយបត្រ / INVOICE</div><br />
                                <strong class="section-title khmer-text">លេខវិក្កយបត្រ / Invoice #:</strong>
                                INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br />
                                <strong class="section-title khmer-text">កាលបរិច្ឆេទ / Created:</strong>
                                {{ $order->created_at->format('d M, Y') }}<br />
                                <strong class="section-title khmer-text">ស្ថានភាព / Status:</strong> <span
                                    class="status-badge">{{ ucfirst($order->status) }}</span><br />
                                <strong class="section-title khmer-text">ការបង់ប្រាក់ / Payment:</strong> <span
                                    class="status-badge">{{ ucfirst($order->payment_status) }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong class="section-title khmer-text">YDLPhoneshop</strong><br />
                                <span class="khmer-text">ឃុំស្រឡប់ ស្រុកត្បូងឃ្មុំ</span><br />
                                <span class="khmer-text">Sralab Commune, Tboung Khmum District</span><br />
                                <span class="khmer-text">ខេត្តត្បូងឃ្មុំ ប្រទេសកម្ពុជា</span><br />
                                <span class="khmer-text">Tboung Khmum Province, Cambodia</span><br />
                                <div class="contact-info">
                                    <span class="phone-number khmer-text"> 071 600 88 81</span><br />
                                    <span class="phone-number khmer-text"> 096 68 444 98</span><br />
                                    <span class="khmer-text"> contact@ydlphoneshop.com</span>
                                </div>
                            </td>
                            <td>
                                <strong class="section-title khmer-text">បង់ទៅ / Bill To:</strong><br />
                                <strong class="khmer-text">{{ $order->address->full_name }}</strong><br />
                                <span class="khmer-text">{{ $order->address->street_address }}</span><br />
                                <span class="khmer-text">{{ $order->address->city }},
                                    {{ $order->address->province }}</span><br />
                                <strong class="section-title khmer-text">ទូរស័ព្ទ / Phone:</strong> <span
                                    class="khmer-text">{{ $order->address->phone }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td class="khmer-text">ផលិតផល / Product</td>
                <td class="khmer-text">បរិមាណ / Quantity</td>
            </tr>

            @foreach ($order->items as $item)
                <tr class="item{{ $loop->last ? ' last' : '' }}">
                    <td class="khmer-text">{{ $item->product->name }}</td>
                    <td class="khmer-text">{{ $item->quantity }} × ${{ number_format($item->unit_amount, 2) }}</td>
                </tr>
            @endforeach

            <tr class="heading">
                <td class="khmer-text">សរុបរង / Subtotal</td>
                <td class="khmer-text">${{ number_format($order->grand_total - $order->shipping_amount, 2) }}</td>
            </tr>

            <tr class="details">
                <td class="khmer-text">ការដឹកជញ្ជូន / Shipping Fee</td>
                <td class="khmer-text">${{ number_format($order->shipping_amount, 2) }}</td>
            </tr>

            <tr class="total">
                <td></td>
                <td class="khmer-text"><strong>សរុប / Total: ${{ number_format($order->grand_total, 2) }}</strong>
                </td>
            </tr>
        </table>

        <div style="margin-top: 40px; text-align: center; color: #666; font-size: 12px;">
            <div class="thank-you-title khmer-text" style="color: #333; margin-bottom: 10px;">
                <strong>អរគុណសម្រាប់ការទិញរបស់អ្នក!</strong><br />
                <strong>Thank you for your purchase!</strong>
            </div>
            <div style="margin-top: 15px;" class="khmer-text">
                <strong>YDLPhoneshop</strong> | contact@ydlphoneshop.com<br />
                <span class="khmer-text">វិក្កយបត្រនេះត្រូវបានបង្កើតដោយស្វ័យប្រវត្តិ</span><br />
                <span class="khmer-text">This invoice was generated automatically on
                    {{ now()->format('d M, Y H:i:s') }}</span>
            </div>
        </div>
    </div>
</body>

</html>