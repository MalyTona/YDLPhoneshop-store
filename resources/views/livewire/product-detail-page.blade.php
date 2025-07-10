<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-4 sm:py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Breadcrumb -->
    <nav class="flex mb-4 sm:mb-8" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs sm:text-sm">
        <li class="inline-flex items-center">
          <a wire:navigate href="/" class="inline-flex items-center font-medium text-gray-700 hover:text-amber-600 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-3 h-3 mr-1.5 sm:mr-2.5" fill="currentColor" viewBox="0 0 20 20">
              <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            ទំព័រដើម
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a wire:navigate href="/products" class="ml-1 font-medium text-gray-700 hover:text-amber-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">ផលិតផល</a>
          </div>
        </li>
        @if($product->category)
        <li class="hidden sm:block">
          <div class="flex items-center">
            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a wire:navigate href="/categories/{{ $product->category->slug ?? $product->category->id }}" class="ml-1 font-medium text-gray-700 hover:text-amber-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ $product->category->name }}</a>
          </div>
        </li>
        @endif
        <li aria-current="page">
          <div class="flex items-center">
            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="ml-1 font-medium text-gray-500 md:ml-2 dark:text-gray-400 truncate">{{ Str::limit($product->name, 20) }}</span>
          </div>
        </li>
      </ol>
    </nav>

    <!-- Product Status Alerts -->
    @if(!$product->is_active)
    <div class="mb-4 sm:mb-6 bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4 dark:bg-red-900/20 dark:border-red-800">
      <div class="flex">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 10.414l1.293-1.293a1 1 0 001.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <div class="ml-3">
          <p class="text-sm text-red-800 dark:text-red-400">ផលិតផលនេះមិនមានលក់នៅពេលនេះទេ។</p>
        </div>
      </div>
    </div>
    @endif

    @if($product->on_sale)
    <div class="mb-4 sm:mb-6 bg-amber-50 border border-amber-200 rounded-lg p-3 sm:p-4 dark:bg-amber-900/20 dark:border-amber-800">
      <div class="flex">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
        </svg>
        <div class="ml-3">
          <p class="text-sm text-amber-800 dark:text-amber-400">🔥 ផលិតផលនេះកំពុងមានការបញ្ចុះតម្លៃ!</p>
        </div>
      </div>
    </div>
    @endif

    <!-- Main Product Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl overflow-hidden">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-8 p-4 sm:p-6 lg:p-8">

        <!-- Image Gallery Section -->
        <div class="space-y-3 sm:space-y-4" x-data="{ 
          mainImage: '{{ $product->images && count($product->images) > 0 ? url('storage', $product->images[0]) : '/images/placeholder-product.png' }}',
          currentIndex: 0,
          images: {{ json_encode($product->images ? array_map(fn($img) => url('storage', $img), $product->images) : ['/images/placeholder-product.png']) }},
          isZoomed: false
        }">

          <!-- Main Image Display -->
          <div class="relative">
            <!-- Main Image Container -->
            <div class="relative bg-gray-100 dark:bg-gray-700 rounded-lg sm:rounded-xl overflow-hidden group cursor-zoom-in"
              @click="isZoomed = true"
              style="aspect-ratio: 1/1;">
              <img
                x-bind:src="mainImage"
                alt="{{ $product->name }}"
                class="w-full h-full object-contain p-2 sm:p-4 transition-transform duration-300 group-hover:scale-105"
                loading="lazy"
                onerror="this.src='/images/placeholder-product.png'">

              <!-- Sale Badge -->
              @if($product->on_sale)
              <div class="absolute top-2 sm:top-4 left-2 sm:left-4 bg-red-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold">
                SALE
              </div>
              @endif

              <!-- Featured Badge -->
              @if($product->is_featured)
              <div class="absolute top-2 sm:top-4 {{ $product->on_sale ? 'left-14 sm:left-20' : 'left-2 sm:left-4' }} bg-amber-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold">
                ⭐ FEATURED
              </div>
              @endif

              <!-- Zoom Icon -->
              <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-white/80 dark:bg-gray-800/80 rounded-full p-1.5 sm:p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                </svg>
              </div>

              <!-- Navigation Arrows for Main Image -->
              <template x-if="images.length > 1">
                <div class="absolute inset-0 flex items-center justify-between px-2 sm:px-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                  <button
                    @click.stop="currentIndex = currentIndex > 0 ? currentIndex - 1 : images.length - 1; mainImage = images[currentIndex]"
                    class="bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-800 rounded-full p-2 sm:p-3 shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                  </button>
                  <button
                    @click.stop="currentIndex = currentIndex < images.length - 1 ? currentIndex + 1 : 0; mainImage = images[currentIndex]"
                    class="bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-800 rounded-full p-2 sm:p-3 shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </button>
                </div>
              </template>

              <!-- Image Counter -->
              <template x-if="images.length > 1">
                <div class="absolute bottom-2 sm:bottom-4 right-2 sm:right-4 bg-black/70 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium">
                  <span x-text="currentIndex + 1"></span>/<span x-text="images.length"></span>
                </div>
              </template>
            </div>
          </div>

          <!-- Thumbnail Gallery -->
          @if($product->images && count($product->images) > 1)
          <div class="space-y-2 sm:space-y-3">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">រូបភាពផ្សេងទៀត</h3>
            <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
              @foreach($product->images as $index => $image)
              <button
                @click="mainImage = '{{ url('storage', $image) }}'; currentIndex = {{ $index }}"
                class="relative aspect-square bg-gray-100 dark:bg-gray-700 rounded-md sm:rounded-lg overflow-hidden border-2 transition-all duration-200 hover:shadow-md"
                :class="currentIndex === {{ $index }} ? 'border-amber-500 ring-2 ring-amber-500/20 shadow-md' : 'border-gray-200 dark:border-gray-600 hover:border-amber-300 dark:hover:border-amber-600'">
                <img
                  src="{{ url('storage', $image) }}"
                  alt="{{ $product->name }} - រូបភាពទី {{ $index + 1 }}"
                  class="w-full h-full object-contain p-1 sm:p-2"
                  loading="lazy"
                  onerror="this.src='/images/placeholder-product.png'">
                <!-- Active Indicator -->
                <div x-show="currentIndex === {{ $index }}" class="absolute inset-0 bg-amber-500/10 flex items-center justify-center">
                  <div class="bg-amber-500 rounded-full p-0.5 sm:p-1">
                    <svg class="w-2 h-2 sm:w-3 sm:h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </button>
              @endforeach
            </div>
          </div>
          @endif

          <!-- Image Zoom Modal -->
          <div x-show="isZoomed"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
            @click="isZoomed = false"
            @keydown.escape.window="isZoomed = false">
            <div class="relative max-w-4xl max-h-full">
              <img
                x-bind:src="mainImage"
                alt="{{ $product->name }}"
                class="max-w-full max-h-full object-contain"
                @click.stop>
              <button
                @click="isZoomed = false"
                class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-white/90 hover:bg-white rounded-full p-2 transition-colors duration-200">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Simple Features Section - Realistic for small shop -->
          <div class="hidden sm:block border-t border-gray-200 dark:border-gray-700 pt-4 sm:pt-6 mt-4 sm:mt-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">សេវាកម្មរបស់យើង</h3>
            <div class="grid grid-cols-1 gap-2 sm:gap-3">
              <div class="flex items-center space-x-2 sm:space-x-3 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs sm:text-sm">ផលិតផលល្អ</span>
              </div>
              <div class="flex items-center space-x-2 sm:space-x-3 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 0a1 1 0 100 2h.01a1 1 0 100-2H9zm2 0a1 1 0 100 2h.01a1 1 0 100-2H11z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs sm:text-sm">មានទទួល ជួសជុលទូរសព្ទ ដោះកូដដៃ បុកប្រូក្រាម អ៊ុតកញ្ចក់ថាច់.ល.</span>
              </div>
              <div class="flex items-center space-x-2 sm:space-x-3 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                <span class="text-xs sm:text-sm">ប្រឹក្សាដោយឥតគិតថ្លៃ​ | 071 600 8881</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Information -->
        <div class="space-y-4 sm:space-y-6">
          <!-- Product Title & Meta -->
          <div class="space-y-3 sm:space-y-4">
            <div>
              <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">
                {{ $product->name }}
              </h1>

              <!-- Category and Brand -->
              <div class="flex flex-wrap items-center gap-3 sm:gap-4 mt-2 sm:mt-3">
                @if($product->category)
                <div class="flex items-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                  <span>ប្រភេទ:</span>
                  <a wire:navigate href="/categories/{{ $product->category->slug ?? $product->category->id }}" class="ml-1 text-amber-600 dark:text-amber-400 font-medium hover:underline">
                    {{ $product->category->name }}
                  </a>
                </div>
                @endif

                @if($product->brand)
                <div class="flex items-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                  <span>ម៉ាក:</span>
                  <a wire:navigate href="/brands/{{ $product->brand->slug ?? $product->brand->id }}" class="ml-1 text-amber-600 dark:text-amber-400 font-medium hover:underline">
                    {{ $product->brand->name }}
                  </a>
                </div>
                @endif
              </div>
            </div>

            <!-- Price Section -->
            <div class="flex items-baseline space-x-2 sm:space-x-3">
              <span class="text-2xl sm:text-3xl lg:text-4xl font-bold text-amber-600 dark:text-amber-400">
                ${{ number_format($product->price, 2) }}
              </span>

              @if($product->on_sale)
              <div class="flex items-center space-x-1 sm:space-x-2">
                <span class="text-lg sm:text-xl text-gray-500 line-through dark:text-gray-400">
                  ${{ number_format($product->price * 1.2, 2) }}
                </span>
                <span class="bg-red-100 text-red-800 text-xs sm:text-sm font-medium px-2 sm:px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                  -17% OFF
                </span>
              </div>
              @endif
            </div>
          </div>
          <!-- Product Description -->
          @if($product->description)
          <div class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed space-y-4 max-w-none
                        [&>h1]:text-2xl [&>h1]:font-bold [&>h1]:text-gray-900 [&>h1]:dark:text-white [&>h1]:mb-4
                        [&>h2]:text-xl [&>h2]:font-semibold [&>h2]:text-gray-900 [&>h2]:dark:text-white [&>h2]:mb-3
                        [&>h3]:text-lg [&>h3]:font-semibold [&>h3]:text-gray-900 [&>h3]:dark:text-white [&>h3]:mb-2
                        [&>p]:text-gray-700 [&>p]:dark:text-gray-300 [&>p]:mb-4
                        [&>a]:text-amber-600 [&>a]:dark:text-amber-400 [&>a]:underline [&>a]:font-medium
                        [&>strong]:text-gray-900 [&>strong]:dark:text-white [&>strong]:font-semibold
                        [&_ul]:list-disc [&_ul]:ml-6 [&_ul]:space-y-1 [&_ul]:text-gray-700 [&_ul]:dark:text-gray-300
                        [&_ol]:list-decimal [&_ol]:ml-6 [&_ol]:space-y-1 [&_ol]:text-gray-700 [&_ol]:dark:text-gray-300
                        [&_li]:text-gray-700 [&_li]:dark:text-gray-300 [&_li]:ml-0
                        [&>blockquote]:border-l-4 [&>blockquote]:border-amber-500 [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-gray-600 [&>blockquote]:dark:text-gray-400
                        [&>code]:bg-gray-100 [&>code]:dark:bg-gray-800 [&>code]:px-1 [&>code]:py-0.5 [&>code]:rounded [&>code]:text-sm [&>code]:text-gray-800 [&>code]:dark:text-gray-200
                        [&_img]:max-w-full [&_img]:h-auto [&_img]:rounded-lg [&_img]:my-4">
            {!! $product->description !!}
          </div>
          @endif
          <div class="flex items-center space-x-2">
            @if($product->in_stock)
            <div class="flex items-center text-green-600 dark:text-green-400">
              <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="font-medium text-sm sm:text-base">មានស្តុក</span>
            </div>
            @else
            <div class="flex items-center text-red-600 dark:text-red-400">
              <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
              </svg>
              <span class="font-medium text-sm sm:text-base">អស់ស្តុក</span>
            </div>
            @endif
          </div>

          <!-- Quantity Selector -->
          @if($product->in_stock && $product->is_active)
          <div class="space-y-2 sm:space-y-3" x-data="{ quantity: 1 }">
            <label class="block text-base sm:text-lg font-semibold text-gray-900 dark:text-white">
              បរិមាណ
            </label>
            <div class="flex items-center space-x-3">
              <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                <button
                  @click="quantity = quantity > 1 ? quantity - 1 : 1"
                  class="px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 transition-colors duration-200">
                  <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                  </svg>
                </button>
                <input
                  x-model="quantity"
                  type="number"
                  min="1"
                  max="99"
                  class="w-16 sm:w-20 px-2 sm:px-4 py-2 sm:py-3 text-center border-0 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-0 focus:outline-none text-sm sm:text-base">
                <button
                  @click="quantity = quantity < 99 ? quantity + 1 : quantity"
                  class="px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 transition-colors duration-200">
                  <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
                </button>
              </div>
              <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                សរុប: <span class="font-semibold text-amber-600 dark:text-amber-400" x-text="'$' + (quantity * {{ $product->price }}).toFixed(2)"></span>
              </span>
            </div>
          </div>
          @endif

          <!-- Action Buttons -->
          <div class="space-y-3 sm:space-y-4">
            @if($product->in_stock && $product->is_active)
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
              <button
                wire:click="addToCart('{{ $product->slug }}')"
                wire:loading.attr="disabled"
                class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-amber-500/20 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
                <span wire:loading.remove>បន្ថែមទៅកន្ត្រក</span>
                <span wire:loading>កំពុងបន្ថែម...</span>
              </button>

              <button
                wire:click="addToWishlist('{{ $product->slug }}')"
                class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span>ចូលចិត្ត</span>
              </button>
            </div>

            <!-- Contact for Purchase Button -->
            <a
              href="https://t.me/Yoth_Dalen"
              target="_blank"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 text-sm sm:text-base">
              <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
              </svg>
              <span>ទំនាក់ទំនងដើម្បីទិញ</span>
            </a>
            @else
            <div class="text-center py-6 sm:py-8">
              <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm sm:text-base">
                {{ !$product->is_active ? 'ផលិតផលនេះមិនមានលក់នៅពេលនេះទេ' : 'ផលិតផលនេះអស់ស្តុក' }}
              </p>
              <button class="bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-semibold py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl cursor-not-allowed text-sm sm:text-base">
                មិនអាចទិញបាន
              </button>
            </div>
            @endif
          </div>

          <!-- Product Meta Information -->
          <div class="border-t border-gray-200 dark:border-gray-700 pt-4 sm:pt-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs sm:text-sm">
              <div>
                <span class="text-gray-500 dark:text-gray-400">SKU:</span>
                <span class="font-medium text-gray-900 dark:text-white ml-1">{{ $product->slug }}</span>
              </div>
              @if($product->category)
              <div>
                <span class="text-gray-500 dark:text-gray-400">ប្រភេទ:</span>
                <span class="font-medium text-gray-900 dark:text-white ml-1">{{ $product->category->name }}</span>
              </div>
              @endif
              @if($product->brand)
              <div>
                <span class="text-gray-500 dark:text-gray-400">ម៉ាក:</span>
                <span class="font-medium text-gray-900 dark:text-white ml-1">{{ $product->brand->name }}</span>
              </div>
              @endif
              <div>
                <span class="text-gray-500 dark:text-gray-400">ស្ថានភាព:</span>
                <span class="font-medium ml-1 {{ $product->in_stock ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                  {{ $product->in_stock ? 'មានស្តុក' : 'អស់ស្តុក' }}
                </span>
              </div>
            </div>
          </div>

          <!-- Mobile Features Section - Realistic for small shop -->
          <div class="sm:hidden border-t border-gray-200 dark:border-gray-700 pt-4">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">សេវាកម្មរបស់យើង</h3>
            <div class="grid grid-cols-1 gap-2">
              <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs">ផលិតផលល្អ</span>
              </div>
              <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 0a1 1 0 100 2h.01a1 1 0 100-2H9zm2 0a1 1 0 100 2h.01a1 1 0 100-2H11z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs">មានទទួល ជួសជុលទូរសព្ទ ដោះកូដដៃ បុកប្រូក្រាម អ៊ុតកញ្ចក់ថាច់.ល. </span>
              </div>
              <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                <svg class="w-4 h-4 text-purple-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                <span class="text-xs">ប្រឹក្សាដោយឥតគិតថ្លៃ​ | 071 600 8881</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg z-50 text-sm sm:text-base max-w-xs sm:max-w-sm"
      x-data="{ show: true }"
      x-show="show"
      x-transition
      x-init="setTimeout(() => show = false, 3000)">
      {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg z-50 text-sm sm:text-base max-w-xs sm:max-w-sm"
      x-data="{ show: true }"
      x-show="show"
      x-transition
      x-init="setTimeout(() => show = false, 3000)">
      {{ session('error') }}
    </div>
    @endif
  </div>
</div>