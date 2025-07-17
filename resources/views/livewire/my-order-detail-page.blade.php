<div class="w-full max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 font-sans">
  {{--
  NOTE: This component assumes you have TailwindCSS configured for dark mode using the 'class' strategy.
  It also assumes the Inter font is loaded in your main layout file.
  --}}

  <div class="flex justify-between items-center mb-8">
    <h1 class="text-4xl font-bold text-slate-800 dark:text-slate-200 tracking-tight">Order Details</h1>
    <span class="text-lg font-medium text-slate-500 dark:text-slate-400">Order #{{ $order->id }}</span>
  </div>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card: Customer -->
    <div
      class="flex flex-col bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl transition hover:shadow-lg">
      <div class="p-5 flex gap-x-5 items-center">
        <div class="flex-shrink-0 flex justify-center items-center size-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
          <svg class="size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>
        <div class="grow">
          <p class="text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Customer</p>
          <p class="mt-1 text-lg font-semibold text-slate-800 dark:text-slate-200">{{$address->full_name}}</p>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card: Order Date -->
    <div
      class="flex flex-col bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl transition hover:shadow-lg">
      <div class="p-5 flex gap-x-5 items-center">
        <div
          class="flex-shrink-0 flex justify-center items-center size-12 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
          <svg class="size-6 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
            <line x1="16" x2="16" y1="2" y2="6" />
            <line x1="8" x2="8" y1="2" y2="6" />
            <line x1="3" x2="21" y1="10" y2="10" />
          </svg>
        </div>
        <div class="grow">
          <p class="text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Order Date</p>
          <p class="mt-1 text-lg font-semibold text-slate-800 dark:text-slate-200">
            {{ $order->created_at->format('d-m-Y') }}
          </p>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card: Order Status -->
    <div
      class="flex flex-col bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl transition hover:shadow-lg">
      <div class="p-5 flex gap-x-5 items-center">
        <div
          class="flex-shrink-0 flex justify-center items-center size-12 bg-amber-100 dark:bg-amber-900/50 rounded-lg">
          <svg class="size-6 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>
        <div class="grow">
          <p class="text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Order Status</p>
          @php
      $statusClasses = match ($order->status) {
        'new' => 'text-blue-800 bg-blue-100 dark:text-blue-200 dark:bg-blue-900/50',
        'processing' => 'text-yellow-800 bg-yellow-100 dark:text-yellow-200 dark:bg-yellow-900/50',
        'shipped' => 'text-teal-800 bg-teal-100 dark:text-teal-200 dark:bg-teal-900/50',
        'delivered' => 'text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50',
        'cancelled' => 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50',
        default => 'text-slate-800 bg-slate-100 dark:text-slate-200 dark:bg-slate-900/50',
      };
      $statusIcon = match ($order->status) {
        'new' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.684-2.684L11.25 18l1.938-.648a3.375 3.375 0 002.684-2.684L16.25 13l.648 1.938a3.375 3.375 0 002.684 2.684L21 18l-1.938.648a3.375 3.375 0 00-2.684 2.684z" /></svg>',
        'processing' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.181-3.183m-4.991-2.69v4.992h-4.992m0 0l-3.181-3.183a8.25 8.25 0 0111.667 0l3.181 3.183" /></svg>',
        'shipped' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v.958m12.022 0H2.985" /></svg>',
        'delivered' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>',
        'cancelled' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" /></svg>',
        default => '',
      };
    @endphp
          <div class="mt-1">
            <span
              class="inline-flex items-center gap-x-1.5 px-3 py-1 text-xs font-medium rounded-full {{ $statusClasses }}">
              {!! $statusIcon !!}
              {{ ucfirst($order->status) }}
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card: Payment Status -->
    <div
      class="flex flex-col bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 shadow-sm rounded-xl transition hover:shadow-lg">
      <div class="p-5 flex gap-x-5 items-center">
        <div class="flex-shrink-0 flex justify-center items-center size-12 bg-teal-100 dark:bg-teal-900/50 rounded-lg">
          <svg class="size-6 text-teal-600 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
            <path d="m9 12 2 2 4-4" />
          </svg>
        </div>
        <div class="grow">
          <p class="text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Payment</p>
          @php
      $paymentStatusClasses = match ($order->payment_status) {
        'paid' => 'text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50',
        'pending' => 'text-amber-800 bg-amber-100 dark:text-amber-200 dark:bg-amber-900/50',
        'failed' => 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50',
        default => 'text-slate-800 bg-slate-100 dark:text-slate-200 dark:bg-slate-900/50',
      };
      $paymentStatusIcon = match ($order->payment_status) {
        'paid' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        'pending' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        'failed' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        default => '',
      };
    @endphp
          <div class="mt-1">
            <span
              class="inline-flex items-center gap-x-1.5 px-3 py-1 text-xs font-medium rounded-full {{ $paymentStatusClasses }}">
              {!! $paymentStatusIcon !!}
              {{ ucfirst($order->payment_status) }}
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  <div class="flex flex-col lg:flex-row gap-8">
    <div class="lg:w-2/3">
      <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
          <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-200">Order Items</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-300">
              <tr>
                <th scope="col" class="px-6 py-3">Product</th>
                <th scope="col" class="px-6 py-3">Price</th>
                <th scope="col" class="px-6 py-3 text-center">Quantity</th>
                <th scope="col" class="px-6 py-3 text-right">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order_items as $item)
          <tr wire:key="{{ $item->id }}"
          class="bg-white dark:bg-slate-800/50 border-b dark:border-slate-700 hover:bg-slate-50/50 dark:hover:bg-slate-700/50">
          <th scope="row" class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 w-full max-w-[200px] sm:max-w-none">
            <img class="h-16 w-16 rounded-md object-cover shrink-0"
              src="{{ url('storage', $item->product->images[0]) }}" alt="{{$item->product->name}}">
            <span class="break-words whitespace-normal text-sm sm:text-base leading-snug">
              {{$item->product->name}}
            </span>
            </div>
          </th>
          <td class="px-6 py-4">{{ Number::currency($item->unit_amount, 'USD')}}</td>
          <td class="px-6 py-4 text-center">{{$item->quantity}}</td>
          <td class="px-6 py-4 text-right font-semibold text-slate-800 dark:text-slate-200">
            {{Number::currency($item->total_amount, 'USD')}}
          </td>
          </tr>
        @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="lg:w-1/3 flex flex-col gap-8">
      <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-semibold mb-4 text-slate-800 dark:text-slate-200">Summary</h2>
        <div class="space-y-3 text-slate-600 dark:text-slate-300">
          <div class="flex justify-between">
            <span>Subtotal</span>
            <span
              class="font-medium text-slate-800 dark:text-slate-200">{{ Number::currency($order->grand_total - $order->shipping_amount, 'USD')}}</span>
          </div>
          <div class="flex justify-between">
            <span>Taxes</span>
            <span class="font-medium text-slate-800 dark:text-slate-200">{{ Number::currency(0, 'USD')}}</span>
          </div>
          <div class="flex justify-between">
            <span>Shipping</span>
            <span
              class="font-medium text-slate-800 dark:text-slate-200">{{ Number::currency($order->shipping_amount, 'USD') }}</span>
          </div>
        </div>
        <hr class="my-4 border-slate-200 dark:border-slate-700">
        <div class="flex justify-between mb-2">
          <span class="font-semibold text-lg text-slate-800 dark:text-slate-200">Grand Total</span>
          <span
            class="font-semibold text-lg text-slate-800 dark:text-slate-200">{{ Number::currency($order->grand_total, 'USD') }}</span>
        </div>
      </div>
      <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-semibold mb-4 text-slate-800 dark:text-slate-200">Shipping Address</h2>
        <div class="text-slate-600 dark:text-slate-300 space-y-2">
          <p class="font-medium text-slate-800 dark:text-slate-200">{{ $address->full_name }}</p>
          <p>{{ $address->street_address}}, {{ $address->city }}, {{$address->province}} {{ $address->zip_code }}</p>
          <p><span class="font-medium">Phone:</span> {{$address->phone}}</p>
        </div>
      </div>
    </div>
  </div>
</div>