<footer class="bg-white dark:bg-gray-900 w-full">
  <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">

    <!-- Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
      <!-- Logo -->
      <div class="col-span-full lg:col-span-1">
        <a href="/" class="flex items-center gap-2 text-white font-semibold text-xl">
          <img src="/images/logo.png" alt="YDL Phoneshop Logo" class="h-auto w-auto">

        </a>
      </div>

      <!-- Product Column -->
      <div class="col-span-1">
        <h4 class="font-semibold text-gray-800 dark:text-amber-500">ផលិតផល</h4>
        <div class="mt-3 grid space-y-3">
          <a href="/categories"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">ប្រភេទផលិតផល</a>
          <a href="/products"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">ផលិតផលទាំងអស់</a>
          <a href="/products"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">ផលិតផលពិសេស</a>
        </div>
      </div>

      <!-- Company Column -->
      <div class="col-span-1">
        <h4 class="font-semibold text-gray-800 dark:text-amber-500">ហាងរបស់យើង</h4>
        <div class="mt-3 grid space-y-3">
          <a wire:navigate href="{{ route('about') }}"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">អំពីពួកយើង</a>
          <a href="#"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">ប្លូក</a>
          <a href="#"
            class="text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition duration-300">អតិថិជន</a>
        </div>
      </div>

      <!-- Social Media -->
      <div class="col-span-1">
        <h4 class="font-semibold text-gray-800 dark:text-amber-500">បណ្តាញសង្គម</h4>
        <div class="mt-4 flex flex-wrap gap-4">
          <a href="https://web.facebook.com/love.cambodia.9440234"
            class="text-gray-600 dark:text-gray-300 hover:text-amber-500 transition-colors duration-200"
            aria-label="Facebook">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
            </svg>
          </a>
          <a href="/" class="text-gray-600 dark:text-gray-300 hover:text-amber-500 transition-colors duration-200"
            aria-label="Instagram">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
            </svg>
          </a>
          <a href="https://t.me/Yoth_Dalen"
            class="text-gray-600 dark:text-gray-300 hover:text-amber-500 transition-colors duration-200"
            aria-label="Telegram" target="_blank" rel="noopener">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M9.996 15.785l-.414 4.06c.592 0 .85-.253 1.163-.555l2.792-2.634 5.786 4.237c1.06.583 1.812.277 2.104-.982L23.94 3.98c.388-1.54-.565-2.137-1.6-1.747L1.69 9.233c-1.52.6-1.504 1.44-.26 1.83l5.872 1.837L18.69 6.92c.623-.392 1.19-.175.723.217" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom Section -->
    <div
      class="mt-10 border-t border-gray-300 dark:border-gray-800 pt-6 flex flex-col md:flex-row items-center justify-between">
      <p class="text-sm text-gray-600 dark:text-gray-400">© <span id="year"></span>
        អភិវឌ្ឍគេហទំព័រអេឡិកត្រូនិកសម្រាប់ហាងទូរស័ព្ទដៃ វ៉ាយឌីអេល</p>

      <p class="text-sm text-gray-600 dark:text-gray-400">
        Website developed by
        <a href="https://www.facebook.com/ly.tona.71" class="text-green-600 hover:text-green-800 font-medium ml-1"
          target="_blank" rel="noopener">
          Maly Tona
        </a>

      </p>
      <p class="text-sm text-gray-600 dark:text-gray-400 text-left">
        Thesis book by
        <a href="https://web.facebook.com/vann.den.907278" class="text-green-600 hover:text-green-800 font-medium ml-1"
          target="_blank" rel="noopener">
          Vannden
        </a>
      </p>
    </div>

  </div>
</footer>