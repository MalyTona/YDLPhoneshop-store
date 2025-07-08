<div class="relative w-full bg-gradient-to-r from-amber-100 to-blue-300 dark:from-slate-900 dark:to-blue-900 py-10 px-4 sm:px-6 lg:px-8 mx-auto overflow-hidden">
    @if($banners->count() > 0)
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Slides Container -->
            <div class="relative min-h-[400px]">
                @foreach($banners as $index => $banner)
                    <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center transition-all duration-500 ease-in-out {{ $currentBanner === $index ? 'opacity-100 relative z-10' : 'opacity-0 absolute inset-0 z-0 pointer-events-none' }}"
                         wire:key="banner-{{ $banner->id }}">
                        <div>
                            <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                                {{ $banner->title }}
                            </h1>
                            @if($banner->title_kh)
                                <h2 class="block text-2xl font-semibold text-gray-700 sm:text-3xl lg:text-4xl mt-2 dark:text-gray-300">
                                    {{ $banner->title_kh }}
                                </h2>
                            @endif
                            <p class="mt-3 text-lg text-gray-800 dark:text-gray-300">
                                {{ $banner->description_kh ?? $banner->description }}
                            </p>
                            <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                                @if($banner->button_url)
                                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 relative z-20" 
                                       href="{{ $banner->button_url }}">
                                        {{ $banner->button_text_kh ?? $banner->button_text }}
                                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6" />
                                        </svg>
                                    </a>
                                @endif
                                <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-800 dark:border-gray-700 dark:text-white dark:hover:bg-slate-700 relative z-20" 
                                   href="https://t.me/Yoth_Dalen" target="_blank">
                                    ទំនាក់ទំនងយើង
                                </a>
                            </div>
                        </div>
                        <div class="relative ms-4">
                            <img class="w-full rounded-md transition-all duration-500" 
                                 src="{{ Storage::url($banner->image_path) }}" 
                                 alt="{{ $banner->title }}">
                            <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Controls -->
            @if($banners->count() > 1)
                <!-- Previous/Next Buttons -->
                <button wire:click="prevSlide" 
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200 z-30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button wire:click="nextSlide" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200 z-30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Dots Indicator -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                    @foreach($banners as $index => $banner)
                        <button wire:click="goToBanner({{ $index }})" 
                                class="w-3 h-3 rounded-full transition-all duration-200 {{ $currentBanner === $index ? 'bg-blue-600' : 'bg-white/50 hover:bg-white/80' }}">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Auto-slide Script -->
        <script>
            document.addEventListener('livewire:initialized', () => {
                let autoSlideInterval = setInterval(() => {
                    Livewire.dispatch('nextSlide');
                }, 5000);

                // Pause auto-slide on hover
                document.querySelector('.relative.w-full').addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                // Resume auto-slide when mouse leaves
                document.querySelector('.relative.w-full').addEventListener('mouseleave', () => {
                    autoSlideInterval = setInterval(() => {
                        Livewire.dispatch('nextSlide');
                    }, 5000);
                });
            });
        </script>
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
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700" href="#">
                            ទិញឥឡូវនេះ
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-800 dark:border-gray-700 dark:text-white dark:hover:bg-slate-700" href="https://t.me/Yoth_Dalen" target="_blank">
                            ទំនាក់ទំនងយើង
                        </a>
                    </div>
                </div>
                <div class="relative ms-4">
                    <img class="w-full rounded-md" src="/images/Banner2.jpg" alt="A person holding a modern smartphone">
                    <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>