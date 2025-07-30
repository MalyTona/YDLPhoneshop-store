@props(['product'])

<div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col"
    wire:key="product-card-{{ $product->id }}">

    <!-- Image Section -->
    <div class="relative  w-full h-52 aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
        <a href="/products/{{ $product->slug }}" wire:navigate>
            <img src="{{ $product->images ? Storage::url($product->images[0]) : '/images/placeholder-product.png' }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300"
                loading="lazy">
        </a>
        @if($product->on_sale)
            <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                SALE
            </div>
        @endif
        @if($product->is_featured)
            <div
                class="absolute top-3 {{ $product->on_sale ? 'left-16' : 'left-3' }} bg-amber-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                ⭐ HOT
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4 sm:p-6 flex flex-col flex-grow justify-between">

        <!-- Product Details -->
        <div class="flex flex-col flex-grow justify-between">
            <!-- Name -->
            <h3
                class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors line-clamp-2 mb-2">
                <a href="/products/{{ $product->slug }}" wire:navigate>
                    {{ $product->name }}
                </a>
            </h3>

            <!-- Tags -->
            <div class="flex flex-wrap items-center gap-2 mb-3">
                @if($product->category)
                    <span
                        class="text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                @endif
                @if($product->brand)
                    <span
                        class="text-xs bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300 px-2 py-1 rounded-full">
                        {{ $product->brand->name }}
                    </span>
                @endif
            </div>

            <!-- Price + Stock -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-baseline space-x-2">
                    <span class="text-xl font-bold text-amber-600 dark:text-amber-400">
                        {{ Number::currency($product->price) }}
                    </span>
                    @if($product->on_sale)
                        <span class="text-sm text-gray-500 line-through dark:text-gray-400">
                            {{ Number::currency($product->price * 1.2) }}
                        </span>
                    @endif
                </div>

                @if($product->in_stock)
                    <div class="flex items-center text-green-600 dark:text-green-400 text-xs font-medium">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                        <span>មានស្តុក</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Button -->
        <div>
            @if($product->in_stock && $product->is_active)
                <button wire:click.prevent="addToCart({{ $product->id }})"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                    <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>បន្ថែមទៅកន្ត្រក</span>
                    <span wire:loading wire:target='addToCart({{ $product->id }})'>កំពុងបន្ថែម...</span>
                </button>
            @else
                <div
                    class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-medium py-2 px-4 rounded-lg cursor-not-allowed flex items-center justify-center">
                    <span class="text-sm">អស់ស្តុក</span>
                </div>
            @endif
        </div>
    </div>
</div>