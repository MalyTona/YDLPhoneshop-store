<div class="bg-gray-50 dark:bg-gray-800 min-h-screen">
    <div class="w-full max-w-7xl py-10 px-4 sm:px-6 lg:px-8 mx-auto">

        <!-- Search Header -->
        <div class="mb-8">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
                <div class="text-center">
                    @if(!empty($search))
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        លទ្ធផលស្វែងរក<span class="text-amber-500">សម្រាប់ "{{ $search }}"</span>
                    </h1>
                    <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        រកឃើញ {{ $totalResults }} {{ $totalResults === 1 ? 'ផលិតផល' : 'ផលិតផល' }}
                    </p>
                    @else
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        ស្វែងរក<span class="text-amber-500">ផលិតផល</span>
                    </h1>
                    <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        ស្វែងរកទូរស័ព្ទដៃ និងគ្រឿងបន្លាស់ពីម៉ាកល្បីៗជាច្រើន ដោយតម្លៃសមរម្យ
                    </p>
                    @endif

                    {{-- Search Form --}}
                    <div class="mt-6 max-w-md mx-auto">
                        <form wire:submit.prevent class="relative">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input
                                    type="search"
                                    wire:model.live.debounce.300ms="search"
                                    class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500 transition-colors duration-300"
                                    placeholder="ស្វែងរកផលិតផល..."
                                    autocomplete="off">
                                @if(!empty($search))
                                <button
                                    type="button"
                                    wire:click="$set('search', '')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($search))
        <!-- Mobile Filters (shown at top on mobile only) -->
        <div class="lg:hidden mb-6 space-y-4 max-w-4xl mx-auto">
            <!-- Categories Filter -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 mx-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">ប្រភេទ</h2>
                <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-4"></div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($categories as $category)
                    <label class="flex items-center group cursor-pointer" wire:key="{{ $category->id }}">
                        <input
                            type="checkbox"
                            id="{{ $category->slug }}"
                            wire:model.live='selected_categories'
                            value="{{ $category->id }}"
                            class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            {{ $category->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Brands Filter -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 mx-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">ម៉ាក</h2>
                <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-4"></div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($brands as $brand)
                    <label class="flex items-center group cursor-pointer" wire:key="{{ $brand->id }}">
                        <input
                            type="checkbox"
                            wire:model.live='selected_brands'
                            id="{{ $brand->slug }}"
                            value="{{ $brand->id }}"
                            class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            {{ $brand->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Product Status & Price Range in one row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mx-2">
                <!-- Product Status Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">ស្ថានភាពផលិតផល</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-4"></div>
                    <div class="space-y-3">
                        <label for='in_stock_mobile' class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id='in_stock_mobile'
                                value='1'
                                wire:model.live='in_stock'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                មានស្តុក
                            </span>
                        </label>
                        <label for="on_sale_mobile" class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id='on_sale_mobile'
                                value='1'
                                wire:model.live='on_sale'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                កំពុងបញ្ចុះតម្លៃ
                            </span>
                        </label>
                        <label for="featured_mobile" class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id="featured_mobile"
                                wire:model.live='featured'
                                value='1'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                ផលិតផលពេញនិយម
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">ជួរតម្លៃ</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-4"></div>
                    <div class="space-y-4">
                        <div class="font-semibold text-center dark:text-white">
                            {{ Number::currency($price_range, 'USD') }}
                        </div>
                        <input
                            wire:model.live='price_range'
                            type="range"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 slider"
                            max="2000"
                            min="50"
                            step="10">
                        <div class="flex justify-between text-sm">
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                                {{ Number::currency(50) }}
                            </span>
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                                {{ Number::currency(2000) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Layout (hidden on mobile) -->
        <div class="hidden lg:grid lg:grid-cols-5 gap-8 max-w-7xl mx-auto">

            <!-- Desktop Sidebar Filters -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Categories Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">ប្រភេទ</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-6"></div>
                    <div class="space-y-3">
                        @foreach ($categories as $category)
                        <label class="flex items-center group cursor-pointer" wire:key="{{ $category->id }}">
                            <input
                                type="checkbox"
                                id="{{ $category->slug }}_desktop"
                                wire:model.live='selected_categories'
                                value="{{ $category->id }}"
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                {{ $category->name }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Brands Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">ម៉ាក</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-6"></div>
                    <div class="space-y-3">
                        @foreach ($brands as $brand)
                        <label class="flex items-center group cursor-pointer" wire:key="{{ $brand->id }}">
                            <input
                                type="checkbox"
                                wire:model.live='selected_brands'
                                id="{{ $brand->slug }}_desktop"
                                value="{{ $brand->id }}"
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                {{ $brand->name }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Product Status Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">ស្ថានភាពផលិតផល</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-6"></div>
                    <div class="space-y-3">
                        <label for='in_stock_desktop' class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id='in_stock_desktop'
                                value='1'
                                wire:model.live='in_stock'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                មានស្តុក
                            </span>
                        </label>
                        <label for="on_sale_desktop" class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id='on_sale_desktop'
                                value='1'
                                wire:model.live='on_sale'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                កំពុងបញ្ចុះតម្លៃ
                            </span>
                        </label>
                        <label for="featured_desktop" class="flex items-center group cursor-pointer">
                            <input
                                type="checkbox"
                                id="featured_desktop"
                                wire:model.live='featured'
                                value='1'
                                class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                ផលិតផលពេញនិយម
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">ជួរតម្លៃ</h2>
                    <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-blue-500 rounded-full mb-6"></div>
                    <div class="space-y-4">
                        <div class="font-semibold text-center dark:text-white">{{Number::currency($price_range,'USD')}}</div>
                        <input
                            wire:model.live='price_range'
                            type="range"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 slider"
                            max="2000"
                            min="50"
                            step="10">
                        <div class="flex justify-between text-sm">
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                                {{ Number::currency(50) }}
                            </span>
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                                {{ Number::currency(2000) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Main Content -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Sort and Filter Bar -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600 dark:text-gray-400">បង្ហាញ</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $products->count() }}</span>
                            <span class="text-gray-600 dark:text-gray-400">ផលិតផល</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label class="text-gray-600 dark:text-gray-400">តម្រៀប:</label>
                            <select wire:model.live="sort" class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 px-3 py-2">
                                <option value="relevance">ពាក់ព័ន្ធបំផុត</option>
                                <option value="latest">ថ្មីបំផុត</option>
                                <option value="highest_price">តម្លៃ: ខ្ពស់ទៅទាប</option>
                                <option value="lowest_price">តម្លៃ: ទាបទៅខ្ពស់</option>
                                <option value="a_z_name">ឈ្មោះ A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if($products->count() > 0)
                <!-- Desktop Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" wire:key="{{ $product->id }}">

                        <!-- Product Image -->
                        <div class="relative aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <a href="/products/{{ $product->slug }}" wire:navigate>
                                <img
                                    src="{{ url('storage', $product->images[0]) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                    onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE5MiIgdmlld0JveD0iMCAwIDIwMCAxOTIiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy9yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMTkyIiBmaWxsPSIjRjNGNEY2Ii8+CjxjaXJjbGUgY3g9IjEwMCIgY3k9Ijk2IiByPSI0MCIgZmlsbD0iI0QxRDVEQiIvPgo8cGF0aCBkPSJNODAgODBIMTIwVjExMkg4MFY4MFoiIGZpbGw9IiNBN0E3QTciLz4KPC9zdmc+Cg=='">
                            </a>

                            <!-- Badges -->
                            @if($product->on_sale)
                            <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                SALE
                            </div>
                            @endif

                            @if($product->is_featured)
                            <div class="absolute top-3 {{ $product->on_sale ? 'left-16' : 'left-3' }} bg-amber-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                ⭐ HOT
                            </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-800 rounded-full p-2 shadow-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 sm:p-6">
                            <div class="mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                    <a href="/products/{{ $product->slug }}" wire:navigate>
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <!-- Category & Brand -->
                                <div class="flex items-center space-x-2 mt-2">
                                    @if($product->category)
                                    <span class="text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                    @endif
                                    @if($product->brand)
                                    <span class="text-xs bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300 px-2 py-1 rounded-full">
                                        {{ $product->brand->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Price -->
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

                                <!-- Stock Status -->
                                <div class="flex items-center">
                                    @if($product->in_stock)
                                    <div class="flex items-center text-green-600 dark:text-green-400">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                        <span class="text-xs font-medium">មានស្តុក</span>
                                    </div>
                                    @else
                                    <div class="flex items-center text-red-600 dark:text-red-400">
                                        <div class="w-2 h-2 bg-red-500 rounded-full mr-1"></div>
                                        <span class="text-xs font-medium">អស់ស្តុក</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <button
                                wire:click="addToCart({{ $product->id }})"
                                class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
                                </svg>
                                <span wire:loading.remove wire:target='addToCart({{ $product->id }})' class="text-sm">បន្ថែមទៅកន្ត្រក</span>
                                <span wire:loading wire:target='addToCart({{ $product->id }})'>កំពុងបន្ថែម...</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-5">
                    <div class="flex justify-center">
                        {{ $products->links() }}
                    </div>
                </div>
                @endif
                @else
                {{-- No Results --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">រកមិនឃើញផលិតផល</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">សូមព្យាយាមកែប្រែពាក្យស្វែងរក ឬតម្រង</p>
                    <button
                        wire:click="clearFilters"
                        class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors duration-200">
                        សម្អាតតម្រង
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Mobile Products Section -->
        <div class="lg:hidden max-w-4xl mx-auto">
            <!-- Sort and Filter Bar -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 mb-6 mx-2">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 dark:text-gray-400">បង្ហាញ</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $products->count() }}</span>
                        <span class="text-gray-600 dark:text-gray-400">ផលិតផល</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-600 dark:text-gray-400">តម្រៀប:</label>
                        <select wire:model.live="sort" class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 px-3 py-2">
                            <option value="relevance">ពាក់ព័ន្ធបំផុត</option>
                            <option value="latest">ថ្មីបំផុត</option>
                            <option value="highest_price">តម្លៃ: ខ្ពស់ទៅទាប</option>
                            <option value="lowest_price">តម្លៃ: ទាបទៅខ្ពស់</option>
                            <option value="a_z_name">ឈ្មោះ A-Z</option>
                        </select>
                    </div>
                </div>
            </div>

            @if($products->count() > 0)
            <!-- Mobile Products Grid (2 columns) -->
            <div class="grid grid-cols-2 gap-4 mx-2">
                @foreach ($products as $product)
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" wire:key="{{ $product->id }}">

                    <!-- Product Image -->
                    <div class="relative aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <a href="/products/{{ $product->slug }}" wire:navigate>
                            <img
                                src="{{ url('storage', $product->images[0]) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-contain p-3 group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                                onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE5MiIgdmlld0JveD0iMCAwIDIwMCAxOTIiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy9yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMTkyIiBmaWxsPSIjRjNGNEY2Ii8+CjxjaXJjbGUgY3g9IjEwMCIgY3k9Ijk2IiByPSI0MCIgZmlsbD0iI0QxRDVEQiIvPgo8cGF0aCBkPSJNODAgODBIMTIwVjExMkg4MFY4MFoiIGZpbGw9IiNBN0E3QTciLz4KPC9zdmc+Cg=='">
                        </a>

                        <!-- Badges -->
                        @if($product->on_sale)
                        <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            SALE
                        </div>
                        @endif

                        @if($product->is_featured)
                        <div class="absolute top-2 {{ $product->on_sale ? 'left-14' : 'left-2' }} bg-amber-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            ⭐ HOT
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-3">
                        <div class="mb-2">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                <a href="/products/{{ $product->slug }}" wire:navigate>
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <!-- Category & Brand -->
                            <div class="flex flex-col space-y-1 mt-2">
                                @if($product->category)
                                <span class="text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full w-fit">
                                    {{ $product->category->name }}
                                </span>
                                @endif
                                @if($product->brand)
                                <span class="text-xs bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300 px-2 py-1 rounded-full w-fit">
                                    {{ $product->brand->name }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex flex-col mb-3">
                            <div class="flex items-baseline space-x-1">
                                <span class="text-lg font-bold text-amber-600 dark:text-amber-400">
                                    {{ Number::currency($product->price) }}
                                </span>
                                @if($product->on_sale)
                                <span class="text-xs text-gray-500 line-through dark:text-gray-400">
                                    {{ Number::currency($product->price * 1.2) }}
                                </span>
                                @endif
                            </div>

                            <!-- Stock Status -->
                            <div class="flex items-center mt-1">
                                @if($product->in_stock)
                                <div class="flex items-center text-green-600 dark:text-green-400">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></div>
                                    <span class="text-xs font-medium">មានស្តុក</span>
                                </div>
                                @else
                                <div class="flex items-center text-red-600 dark:text-red-400">
                                    <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                    <span class="text-xs font-medium">អស់ស្តុក</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        @if($product->in_stock && $product->is_active)
                        <button wire:click.prevent="addToCart({{ $product->id }})" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-3 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <span wire:loading.remove wire:target='addToCart({{ $product->id }})' class="text-xs">ទិញ</span>
                            <span wire:loading wire:target='addToCart({{ $product->id }})'>កំពុងទិញ...</span>
                        </button>
                        @else
                        <button class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-medium py-2 px-3 rounded-lg cursor-not-allowed">
                            <span class="text-xs">អស់ស្តុក</span>
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Mobile Pagination -->
            @if($products->hasPages())
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 mt-6 mb-5 mx-2">
                <div class="flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
            @endif
            @else
            {{-- No Results Mobile --}}
            <div class="text-center py-16 mx-2">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">រកមិនឃើញផលិតផល</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">សូមព្យាយាមកែប្រែពាក្យស្វែងរក ឬតម្រង</p>
                <button
                    wire:click="clearFilters"
                    class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors duration-200">
                    សម្អាតតម្រង
                </button>
            </div>
            @endif
        </div>
        @else
        {{-- Empty Search State --}}
        <div class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">ចាប់ផ្តើមស្វែងរក</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">បញ្ចូលពាក្យស្វែងរកដើម្បីរកផលិតផល</p>
        </div>
        @endif
    </div>
</div>