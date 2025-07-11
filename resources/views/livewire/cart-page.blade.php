<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    {{-- Header Section --}}
    <div class="mb-8">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Shopping Cart</h1>
          <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ count($cart_items) }} {{ count($cart_items) === 1 ? 'item' : 'items' }} in your cart
          </p>
        </div>
      </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
      {{-- Cart Items Section --}}
      <div class="lg:w-2/3">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
          @forelse ($cart_items as $item)
          <div wire:key="{{ $item['product_id'] }}"
            class="p-6 border-b border-gray-200 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
              {{-- Product Image & Info --}}
              <div class="flex items-center gap-4 flex-1">
                <div class="relative group">
                  <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 flex-shrink-0">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                      src="{{ url('storage/' . $item['image']) }}"
                      alt="{{ $item['name'] }}"
                      onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTYiIGhlaWdodD0iOTYiIHZpZXdCb3g9IjAgMCA5NiA5NiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9Ijk2IiBoZWlnaHQ9Ijk2IiBmaWxsPSIjRjNGNEY2Ii8+CjxjaXJjbGUgY3g9IjQ4IiBjeT0iNDgiIHI9IjIwIiBmaWxsPSIjRDFENURCIi8+CjxwYXRoIGQ9Ik00MCA0MEg1NlY1Nkg0MFY0MFoiIGZpbGw9IiNBN0E3QTciLz4KPC9zdmc+Cg=='">
                  </div>
                  {{-- Stock indicator --}}
                  <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                </div>
                <div class="flex-1 min-w-0">
                  <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-1 truncate">
                    {{ $item['name'] }}
                  </h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                    SKU: #{{ str_pad($item['product_id'], 6, '0', STR_PAD_LEFT) }}
                  </p>
                  <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                      In Stock
                    </span>
                  </div>
                </div>
              </div>

              {{-- Price --}}
              <div class="text-center sm:text-left">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Unit Price</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                  {{ Number::currency($item['unit_amount'], 'USD') }}
                </p>
              </div>

              {{-- Quantity Controls --}}
              <div class="text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Quantity</p>
                <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                  <button wire:click="decreaseQty({{ $item['product_id'] }})"
                    class="w-8 h-8 rounded-md flex items-center justify-center hover:bg-white dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-all duration-200 disabled:opacity-50"
                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                  </button>
                  <div class="mx-3 min-w-[2rem] text-center">
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $item['quantity'] }}</span>
                  </div>
                  <button wire:click="increaseQty({{ $item['product_id'] }})"
                    class="w-8 h-8 rounded-md flex items-center justify-center hover:bg-white dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                  </button>
                </div>
              </div>

              {{-- Total Price --}}
              <div class="text-center sm:text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">
                  {{ Number::currency($item['total_amount'], 'USD') }}
                </p>
              </div>

              {{-- Remove Button --}}
              <div class="flex justify-center sm:justify-end">
                <button wire:click="removeItem({{ $item['product_id'] }})"
                  class="group relative w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-red-100 dark:hover:bg-red-900/30 text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 flex items-center justify-center"
                  title="Remove item">
                  <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </span>
                  <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
          </div>
          @empty
          {{-- Empty Cart State --}}
          <div class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
              <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Your cart is empty</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Add some products to get started</p>
            <a href="/products"
              class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
              Continue Shopping
            </a>
          </div>
          @endforelse
        </div>
      </div>

      {{-- Order Summary Section --}}
      <div class="lg:w-1/3">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sticky top-6">
          {{-- Summary Header --}}
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Order Summary</h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($cart_items) }} items</span>
          </div>

          {{-- Summary Details --}}
          <div class="space-y-4 mb-6">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
              <span class="font-semibold text-gray-900 dark:text-white">{{ Number::currency($subtotal, 'USD') }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600 dark:text-gray-400">Shipping (Cambodia Local)</span>
              <span class="font-semibold text-gray-900 dark:text-white">{{ Number::currency(2, 'USD') }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600 dark:text-gray-400">Tax</span>
              <span class="font-semibold text-gray-900 dark:text-white">{{ Number::currency(0, 'USD') }}</span>
            </div>
          </div>

          {{-- Total --}}
          <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
            <div class="flex justify-between items-center">
              <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
              <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ Number::currency($grand_total, 'USD') }}</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Including taxes and shipping</p>
          </div>

          {{-- Checkout Button --}}
          @if ($cart_items)
          <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl mb-4">
            <span class="flex items-center justify-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
              Secure Checkout
            </span>
          </button>

          {{-- Continue Shopping --}}
          <a href="/products"
            class="block w-full text-center py-3 px-6 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-gray-400 dark:hover:border-gray-500 font-medium rounded-xl transition-colors duration-200">
            Continue Shopping
          </a>
          @endif

          {{-- Security Badges --}}
          <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
                Secure Payment
              </div>
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                SSL Protected
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>