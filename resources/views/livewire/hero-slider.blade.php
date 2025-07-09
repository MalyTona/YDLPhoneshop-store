<div class="relative w-full bg-gradient-to-r from-amber-100 to-blue-300 dark:from-slate-900 dark:to-blue-900 py-10 px-4 sm:px-6 lg:px-8 mx-auto overflow-hidden"
     x-data="{
        autoSlideInterval: null,
        isHovered: false,
        isTransitioning: false,
        currentBanner: @entangle('currentBanner'),
        init() {
            this.startAutoSlide();
        },
        startAutoSlide() {
            this.autoSlideInterval = setInterval(() => {
                if (!this.isHovered && !this.isTransitioning) {
                    this.nextSlide();
                }
            }, 5000);
        },
        stopAutoSlide() {
            if (this.autoSlideInterval) {
                clearInterval(this.autoSlideInterval);
            }
        },
        pauseAutoSlide() {
            this.isHovered = true;
        },
        resumeAutoSlide() {
            this.isHovered = false;
        },
        nextSlide() {
            if (!this.isTransitioning) {
                this.isTransitioning = true;
                $wire.nextSlide();
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 800);
            }
        },
        prevSlide() {
            if (!this.isTransitioning) {
                this.isTransitioning = true;
                $wire.prevSlide();
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 800);
            }
        },
        goToBanner(index) {
            if (!this.isTransitioning) {
                this.isTransitioning = true;
                $wire.goToBanner(index);
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 800);
            }
        }
     }"
     @mouseenter="pauseAutoSlide()"
     @mouseleave="resumeAutoSlide()">

    @if($banners->count() > 0)
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Slides Container -->
            <div class="relative min-h-[400px]">
                @foreach($banners as $index => $banner)
                    <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center transition-all duration-800 ease-in-out transform"
                         :class="{
                            'opacity-100 translate-x-0 scale-100 relative z-10 pointer-events-auto': currentBanner === {{ $index }},
                            'opacity-0 translate-x-8 scale-95 absolute inset-0 z-0 pointer-events-none': currentBanner !== {{ $index }} && currentBanner < {{ $index }},
                            'opacity-0 -translate-x-8 scale-95 absolute inset-0 z-0 pointer-events-none': currentBanner !== {{ $index }} && currentBanner > {{ $index }}
                         }"
                         wire:key="banner-{{ $banner->id }}">
                        
                        <div x-show="currentBanner === {{ $index }}"
                             x-transition:enter="transition-all duration-1000 ease-out delay-200"
                             x-transition:enter-start="opacity-0 transform translate-y-8"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition-all duration-600 ease-in"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-4">
                            
                            <!-- Main Title with Enhanced Styling -->
                            <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white transform transition-all duration-500">
                                @if(str_contains($banner->title, 'YDLPhoneShop'))
                                    {!! str_replace('YDLPhoneShop', '<span class="text-blue-600 dark:text-blue-500">YDLPhoneShop</span>', $banner->title) !!}
                                @else
                                    {{ $banner->title }}
                                @endif
                            </h1>
                                                        
                            <!-- Khmer Title with Enhanced Styling -->
                            @if($banner->title_kh)
                                <h2 class="block text-2xl font-semibold text-gray-700 sm:text-3xl lg:text-4xl mt-2 dark:text-gray-300 transform transition-all duration-500 delay-100">
                                    {{ $banner->title_kh }}
                                </h2>
                            @endif
                                                        
                            <!-- Description with Enhanced Styling -->
                            <p class="mt-3 text-lg text-gray-800 dark:text-gray-300 leading-relaxed transform transition-all duration-500 delay-200">
                                {{ $banner->description_kh ?? $banner->description }}
                            </p>
                                                        
                            <!-- Buttons with Enhanced Styling -->
                            <div class="mt-7 grid gap-3 w-full sm:inline-flex transform transition-all duration-500 delay-300">
                                @if($banner->button_url)
                                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 relative z-20 transform hover:scale-105 hover:shadow-lg active:scale-95"
                                        href="{{ $banner->button_url }}">
                                        {{ $banner->button_text_kh ?? $banner->button_text }}
                                        <svg class="flex-shrink-0 w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6" />
                                        </svg>
                                    </a>
                                @endif
                                <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-slate-800 dark:border-gray-700 dark:text-white dark:hover:bg-slate-700 dark:focus:ring-slate-600 transition-all duration-300 relative z-20 transform hover:scale-105 hover:shadow-lg active:scale-95"
                                    href="https://t.me/Yoth_Dalen" target="_blank">
                                    ទំនាក់ទំនងយើង
                                </a>
                            </div>
                        </div>
                        
                        <div class="relative ms-4"
                             x-show="currentBanner === {{ $index }}"
                             x-transition:enter="transition-all duration-1000 ease-out delay-400"
                             x-transition:enter-start="opacity-0 transform translate-x-12 scale-90"
                             x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                             x-transition:leave="transition-all duration-600 ease-in"
                             x-transition:leave-start="opacity-100 transform translate-x-0 scale-100"
                             x-transition:leave-end="opacity-0 transform -translate-x-8 scale-90">
                            <img class="w-full rounded-md transition-all duration-700 shadow-lg hover:shadow-2xl transform hover:scale-105"
                                  src="{{ Storage::url($banner->image_path) }}"
                                  alt="{{ $banner->title }}"
                                  loading="lazy">
                            <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0 transition-all duration-700">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Navigation Controls -->
            @if($banners->count() > 1)
                <!-- Previous/Next Buttons -->
                <button @click="prevSlide()"
                         :disabled="isTransitioning"
                         class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 z-30 backdrop-blur-sm hover:scale-110 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                         :class="{ 'hover:scale-100 active:scale-100': isTransitioning }">
                    <svg class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                                
                <button @click="nextSlide()"
                         :disabled="isTransitioning"
                         class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 z-30 backdrop-blur-sm hover:scale-110 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                         :class="{ 'hover:scale-100 active:scale-100': isTransitioning }">
                    <svg class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Dots Indicator -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                    @foreach($banners as $index => $banner)
                        <button @click="goToBanner({{ $index }})"
                                 :disabled="isTransitioning"
                                 class="w-3 h-3 rounded-full transition-all duration-300 transform hover:scale-125 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed"
                                 :class="{
                                    'bg-blue-600 scale-110 shadow-lg': currentBanner === {{ $index }},
                                    'bg-white/60 hover:bg-white/90 scale-100': currentBanner !== {{ $index }} && !isTransitioning,
                                    'bg-white/40': currentBanner !== {{ $index }} && isTransitioning
                                 }">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Progress Bar -->
        @if($banners->count() > 1)
            <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20 z-20">
                <div class="h-full bg-blue-600 transition-all duration-[5000ms] ease-linear"
                     :class="{ 
                        'w-full': !isHovered && !isTransitioning, 
                        'w-0': isHovered || isTransitioning 
                     }">
                </div>
            </div>
        @endif
        
    @else
        <!-- Fallback to original static content -->
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Welcome to <span class="text-blue-600 dark:text-blue-500">YDLPhoneShop</span>
                    </h1>
                    <h2 class="block text-2xl font-semibold text-gray-700 sm:text-3xl lg:text-4xl mt-2 dark:text-gray-300">
                        ហាងទូរសព្ទដៃរយ៉តដាឡែន
                    </h2>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-300">
                        ស្វែងរកស្មាតហ្វូនស៊េរីថ្មីៗ គ្រឿងបន្លាស់ និងសេវាកម្មជួសជុលប្រកបដោយជំនាញជាច្រើនប្រភេទ។ ហាងតែមួយគត់សម្រាប់រាល់តម្រូវការទូរស័ព្ទរបស់អ្នក។
                    </p>
                    <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all duration-300 transform hover:scale-105" href="#">
                            ទិញឥឡូវនេះ
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-800 dark:border-gray-700 dark:text-white dark:hover:bg-slate-700 transition-all duration-300 transform hover:scale-105" href="https://t.me/Yoth_Dalen" target="_blank">
                            ទំនាក់ទំនងយើង
                        </a>
                    </div>
                </div>
                <div class="relative ms-4">
                    <img class="w-full rounded-md transition-all duration-500 hover:scale-105" src="/images/Banner2.jpg" alt="A person holding a modern smartphone">
                    <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>