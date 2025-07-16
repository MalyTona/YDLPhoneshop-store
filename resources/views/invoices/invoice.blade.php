@php
    // This helper function remains the same. It finds the hashed CSS file from Vite's manifest.
    function getViteAsset(string $path): string
    {
        $manifestPath = public_path('build/manifest.json');
        if (!file_exists($manifestPath)) {
            return '';
        }
        $manifest = json_decode(file_get_contents($manifestPath), true);
        $file = $manifest[$path]['file'] ?? '';
        $css = $manifest[$path]['css'][0] ?? '';

        $assetPath = public_path('build/' . ($file ?: $css));

        if (!file_exists($assetPath)) {
            return '';
        }

        return file_get_contents($assetPath);
    }

    $tailwindCss = getViteAsset('resources/css/invoice.css');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        /* Embed the compiled Tailwind CSS */
        {!! $tailwindCss !!}

        /* Basic body font for PDF rendering */
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>

<body class="p-10 text-sm text-gray-800">
    <div class="container mx-auto">
        <div class="flex justify-between pb-6 mb-8 border-b-2 border-gray-300">
            <div>
                @php
                    try {
                        $logoPath = public_path('images/logo.png');
                        if (file_exists($logoPath)) {
                            $logoData = base64_encode(file_get_contents($logoPath));
                            echo '<img src="data:image/png;base64,' . $logoData . '" class="w-40" alt="Shop Logo">';
                        } else {
                            echo '<h1 class="text-2xl font-bold">YDLPhoneshop</h1>';
                        }
                    } catch (Exception $e) {
                        echo '<h1 class="text-2xl font-bold">YDLPhoneshop</h1>';
                    }
                @endphp
                <div class="mt-4 text-gray-600">
                    <strong>YDLPhoneshop</strong><br>
                    Nikom Leu Village, Sralab Commune<br>
                    Tboung Khmum District, Tboung Khmum Province<br>
                    National Road 73, Cambodia
                </div>
            </div>
            <div class="text-right">
                <h1 class="text-3xl font-bold uppercase text-gray-900">Invoice</h1>
                <p class="mt-2 text-gray-600">
                    <strong>Invoice #:</strong> INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}
                </p>
            </div>
        </div>

        <div class="mb-10">
            <strong class="text-gray-900">Billed To:</strong>
            <div class="text-gray-600">
                {{ $order->address->full_name }}<br>
                {{ $order->address->street_address }}, {{ $order->address->city }}, {{ $order->address->province }}<br>
                {{ $order->address->phone }}
            </div>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-100 text-gray-900">
                    <th class="p-3 font-bold">Product</th>
                    <th class="p-3 font-bold text-center">Quantity</th>
                    <th class="p-3 font-bold text-right">Unit Price</th>
                    <th class="p-3 font-bold text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr class="border-b border-gray-200">
                        <td class="p-3">{{ $item->product->name }}</td>
                        <td class="p-3 text-center">{{ $item->quantity }}</td>
                        <td class="p-3 text-right">${{ number_format($item->unit_amount, 2) }}</td>
                        <td class="p-3 text-right">${{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-8">
            <div class="w-2/5">
                <table class="w-full">
                    <tr class="text-gray-600">
                        <td class="py-2">Subtotal:</td>
                        <td class="py-2 text-right">
                            ${{ number_format($order->grand_total - $order->shipping_amount, 2) }}</td>
                    </tr>
                    <tr class="text-gray-600">
                        <td class="py-2">Shipping Fee:</td>
                        <td class="py-2 text-right">${{ number_format($order->shipping_amount, 2) }}</td>
                    </tr>
                    <tr class="font-bold text-lg text-gray-900 border-t-2 border-b-2 border-gray-800">
                        <td class="py-3">Total Amount:</td>
                        <td class="py-3 text-right">${{ number_format($order->grand_total, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-16 text-center text-gray-600">
            <p>Thank you for your purchase!</p>
            <p class="text-xs">YDLPhoneshop | contact@ydlphoneshop.com</p>
        </div>
    </div>
</body>

</html>