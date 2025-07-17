<div class="w-full max-w-[85rem] py-10 px-2 sm:px-4 lg:px-8 mx-auto">
  <section class="flex items-center font-poppins dark:bg-gray-800">
    <div
      class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-900 dark:bg-gray-900 md:py-10 md:px-10">
      <div>
        <!-- Success Message Header -->
        <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700 dark:text-gray-300 break-words">
          អរគុណ។ ការបញ្ជាទិញរបស់អ្នកត្រូវ<span class="text-amber-500">បានទទួលហើយ។</span>
        </h1>

        <!-- Order Information Summary -->
        <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
          <div class="w-full px-4 mb-4 md:w-1/4">
            <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400">
              Order Number:
            </p>
            <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400 break-words">
              #{{ $order->id }}
            </p>
          </div>
          <div class="w-full px-4 mb-4 md:w-1/4">
            <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400">
              Date:
            </p>
            <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
              {{ $order->created_at->format('d-m-Y') }}
            </p>
          </div>
          <div class="w-full px-4 mb-4 md:w-1/4">
            <p class="mb-2 text-sm font-medium leading-5 text-gray-800 dark:text-gray-400">
              Total:
            </p>
            <p class="text-base font-semibold leading-4 text-blue-600 dark:text-gray-400">
              {{ \Illuminate\Support\Number::currency($order->grand_total, 'USD') }}
            </p>
          </div>
          <div class="w-full px-4 mb-4 md:w-1/4">
            <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400">
              Payment Method:
            </p>
            <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
              {{ $order->payment_method == 'stripe' ? 'Card' : 'Bakong' }}
            </p>
          </div>
        </div>

        <!-- Order Items Table -->
        <div class="px-4 mb-10">
          <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-400">Order Details</h2>
          <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-2 sm:px-6 py-3">Product</th>
                  <th scope="col" class="px-2 sm:px-6 py-3">Unit Price</th>
                  <th scope="col" class="px-2 sm:px-6 py-3">Quantity</th>
                  <th scope="col" class="px-2 sm:px-6 py-3 text-right">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->items as $item)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-2 sm:px-6 py-4 font-medium text-gray-900 break-words dark:text-white">
            {{ $item->product->name }}
            </td>
            <td class="px-2 sm:px-6 py-4">
            {{ \Illuminate\Support\Number::currency($item->unit_amount, 'USD') }}
            </td>
            <td class="px-2 sm:px-6 py-4">
            {{ $item->quantity }}
            </td>
            <td class="px-2 sm:px-6 py-4 text-right">
            {{ \Illuminate\Support\Number::currency($item->quantity * $item->unit_amount, 'USD') }}
            </td>
          </tr>
        @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Order Totals Summary -->
        <div class="flex justify-end px-4 mb-10">
          <div class="w-full md:w-1/3">
            <div class="flex flex-col p-4 space-y-2 bg-gray-50 dark:bg-gray-700 rounded-md">
              <div class="flex items-center justify-between">
                <p class="text-sm leading-4 text-gray-800 dark:text-gray-400">Subtotal</p>
                <p class="text-sm leading-4 text-gray-600 dark:text-gray-400">
                  {{ \Illuminate\Support\Number::currency($subtotal, 'USD') }}</p>
              </div>
              <div class="flex items-center justify-between">
                <p class="text-sm leading-4 text-gray-800 dark:text-gray-400">Shipping</p>
                <p class="text-sm leading-4 text-gray-600 dark:text-gray-400">
                  {{ \Illuminate\Support\Number::currency($order->shipping_amount, 'USD') }}</p>
              </div>
              <div class="flex items-center justify-between">
                <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">Total</p>
                <p class="text-base font-semibold leading-4 text-gray-600 dark:text-gray-400">
                  {{ \Illuminate\Support\Number::currency($order->grand_total, 'USD') }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Shipping and Billing Information -->
        <div class="grid grid-cols-1 gap-8 px-4 mb-10 md:grid-cols-2">
          <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-400">Shipping Address</h2>
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md break-words">
              <p class="text-gray-800 dark:text-gray-400">{{ $order->address->full_name }}</p>
              <p class="text-gray-600 dark:text-gray-400">{{ $order->address->street_address }}</p>
              <p class="text-gray-600 dark:text-gray-400">{{ $order->address->province }}</p>
              <p class="text-gray-600 dark:text-gray-400">{{ $order->address->phone }}</p>
            </div>
          </div>
          <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-400">Shipping Method</h2>
            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
              <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class
                  patriotic="w-8 h-8 text-blue-600 dark:text-blue-400 bi bi-truck" viewBox="0 0 16 16">
                  <path
                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                  </path>
                </svg>
              </div>
              <div>
                <p class="text-lg font-semibold leading-6 text-gray-800 dark:text-gray-400 break-words">
                  {{ $order->shipping_method }}</p>
                <p class="text-sm font-normal text-gray-600 dark:text-gray-400">Delivery within 24 Hours</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-start gap-4 px-4 mt-6">
          <a href="/products"
            class="w-full text-center px-4 py-2 min-h-[44px] text-blue-500 border border-blue-500 rounded-md hover:text-white hover:bg-blue-600 dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-300">
            Go back shopping
          </a>
          <a href="/my-orders"
            class="w-full text-center px-4 py-2 min-h-[44px] bg-blue-500 rounded-md text-gray-50 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800 dark:text-gray-300">
            View My Orders
          </a>
        </div>
      </div>
    </div>
  </section>
</div>