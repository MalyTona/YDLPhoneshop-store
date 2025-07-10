<div>
    {{-- Back to Top Button --}}
    <button
        x-data="{ 
            show: false,
            init() {
                window.addEventListener('scroll', () => {
                    this.show = window.pageYOffset > 300;
                });
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-800"
        aria-label="Back to top"
        title="Back to top">
        {{-- Arrow Up Icon --}}
        <svg class="w-5 h-5 transform group-hover:-translate-y-0.5 transition-transform duration-200"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>

        {{-- Pulse Ring Effect --}}
        <div class="absolute inset-0 rounded-full bg-amber-600 dark:bg-amber-500 animate-ping opacity-20"></div>
    </button>
</div>