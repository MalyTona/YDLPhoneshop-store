<div>
  <div class="bg-gray-50 dark:bg-gray-800 min-h-screen">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
      
      <!-- Page Header -->
      <div class="mb-8">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
          <div class="text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
              ផលិតផល<span class="text-amber-500">ទាំងអស់</span>
            </h1>
            <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
              ស្វែងរកទូរស័ព្ទដៃ និងគ្រឿងបន្លាស់ពីម៉ាកល្បីៗជាច្រើន ដោយតម្លៃសមរម្យ
            </p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <!-- Sidebar Filters -->
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
                  id="{{ $category->slug }}" 
                  value="{{ $category->id }}" 
                  class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
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
                  id="{{ $brand->slug }}" 
                  value="{{ $brand->id }}" 
                  class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
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
              <label class="flex items-center group cursor-pointer">
                <input 
                  type="checkbox" 
                  class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                  មានស្តុក
                </span>
              </label>
              <label class="flex items-center group cursor-pointer">
                <input 
                  type="checkbox" 
                  class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <span class="ml-3 text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                  កំពុងបញ្ចុះតម្លៃ
                </span>
              </label>
              <label class="flex items-center group cursor-pointer">
                <input 
                  type="checkbox" 
                  class="w-4 h-4 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 dark:focus:ring-amber-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
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
              <input 
                type="range" 
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 slider" 
                max="500000" 
                value="100000" 
                step="10000"
              >
              <div class="flex justify-between text-sm">
                <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                  $10
                </span>
                <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-full font-medium">
                  $5000
                </span>
              </div>
            </div>
          </div>

        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
          
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
                <select class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 px-3 py-2">
                  <option value="">ថ្មីបំផុត</option>
                  <option value="">តម្លៃ: ទាបទៅខ្ពស់</option>
                  <option value="">តម្លៃ: ខ្ពស់ទៅទាប</option>
                  <option value="">ឈ្មោះ A-Z</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Products Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    onerror="this.src='/images/placeholder-product.png'"
                  >
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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
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
                <div class="flex space-x-2">
                  @if($product->in_stock && $product->is_active)
                  <button class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <span class="text-sm">បន្ថែមទៅកន្ត្រក</span>
                  </button>
                  @else
                  <button class="flex-1 bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-medium py-2 px-4 rounded-lg cursor-not-allowed">
                    <span class="text-sm">មិនអាចទិញបាន</span>
                  </button>
                  @endif
                  
                  <button class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 p-2 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Pagination -->
          @if($products->hasPages())
          <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex justify-center">
              {{ $products->links() }}
            </div>
          </div>
          @endif

        </div>
      </div>
    </div>
  </div>

  <style>
  .slider::-webkit-slider-thumb {
    appearance: none;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #f59e0b;
    cursor: pointer;
    box-shadow: 0 0 2px 0 #555;
    transition: background .15s ease-in-out;
  }

  .slider::-webkit-slider-thumb:hover {
    background: #d97706;
  }

  .slider::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #f59e0b;
    cursor: pointer;
    border: none;
    box-shadow: 0 0 2px 0 #555;
    transition: background .15s ease-in-out;
  }

  .slider::-moz-range-thumb:hover {
    background: #d97706;
  }
  </style>
</div>
