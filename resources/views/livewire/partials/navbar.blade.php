<header class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-gray-50 dark:bg-gray-900 text-sm py-3 md:py-0 shadow-md">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
    <div class="relative md:flex md:items-center md:justify-between">
      <div class="flex items-center justify-between">
        <a href="/" aria-label="Brand" class="flex items-center gap-2">
          <img src="/images/logo.png" alt="YDLPhoneshop Logo" class="h-auto w-auto">
        </a>

        <!-- Mobile Search Toggle Button -->
        <div class="flex items-center gap-2 md:hidden">
          <!-- Mobile Search Button -->
          <button 
            type="button" 
            id="mobile-search-toggle"
            class="flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700"
            aria-label="Toggle search">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
          </button>
          
          <!-- Mobile Menu Toggle -->
          <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Search Bar (Hidden by default) -->
      <div id="mobile-search-bar" class="hidden w-full mt-3 md:hidden">
        <form action="/search" method="GET" class="relative">
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
            </div>
            <input 
              type="search" 
              name="q"
              id="mobile-search-input" 
              class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500 transition-colors duration-300" 
              placeholder="ស្វែងរកផលិតផល..."
              autocomplete="off"
            >
          </div>
        </form>
      </div>

      <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-between md:gap-x-4 lg:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 dark:divide-gray-700">

            <!-- Navigation Links - Hidden on small screens when space is limited -->
            <div class="flex flex-col md:flex-row md:items-center md:gap-x-4 lg:gap-x-7 xl:hidden">
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/" aria-current="page">ទំព័រដើម</a>
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/categories">ប្រភេទផលិតផល</a>
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/products">ផលិតផល</a>
            </div>

            <!-- Navigation Links - Visible on larger screens -->
            <div class="hidden xl:flex xl:items-center xl:gap-x-7">
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/" aria-current="page">ទំព័រដើម</a>
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/categories">ប្រភេទផលិតផល</a>
              <a class="font-medium text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/products">ផលិតផល</a>
            </div>

            <!-- Desktop Search Bar -->
            <div class="hidden md:block py-3 md:py-0 flex-1 max-w-md lg:max-w-lg xl:max-w-xl">
              <form action="/search" method="GET" class="relative">
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                  </div>
                  <input 
                    type="search" 
                    name="q"
                    id="desktop-search-input" 
                    class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500 transition-colors duration-300" 
                    placeholder="ស្វែងរកផលិតផល..."
                    autocomplete="off"
                  >
                  <!-- Clear button -->
                  <button 
                    type="button" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-300"
                    onclick="document.getElementById('desktop-search-input').value = ''; document.getElementById('desktop-search-input').focus();"
                    style="display: none;"
                    id="clear-desktop-search"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
              </form>
            </div>

            <!-- Right Side Actions -->
            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-x-4">
              <!-- Cart -->
              <a class="font-medium flex items-center text-gray-700 py-3 md:py-6 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500 transition-colors duration-300" href="/cart">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="mr-1 md:hidden lg:inline">កន្ត្រក</span>
                <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-amber-100 border border-amber-300 text-amber-700">4</span>
              </a>

              <!-- Login & Theme Toggle -->
              <div class="flex items-center space-x-2 py-3 md:py-6">
                <!-- Login Button -->
                <div>
                  <!-- Icon-only version for smaller screens -->
                  <a
                    class="lg:hidden flex justify-center items-center w-10 h-10 text-sm font-semibold rounded-lg border border-transparent bg-amber-600 text-white hover:bg-amber-700 transition-colors duration-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-amber-600"
                    href="/login"
                    aria-label="ចូលគណនី">
                    <svg
                      class="w-5 h-5"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                  </a>
                  
                  <!-- Full button version for larger screens -->
                  <a
                    class="hidden lg:inline-flex py-2.5 px-4 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-amber-600 text-white hover:bg-amber-700 transition-colors duration-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-amber-600"
                    href="/login">
                    <svg
                      class="w-4 h-4"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                    ចូលគណនី
                  </a>
                </div>

                <!-- Dark Mode Toggle -->
                <!-- <div>
                  <button
                    id="theme-toggle"
                    class="flex justify-center items-center w-10 h-10 text-amber-500 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-200 dark:focus:ring-amber-700 rounded-lg text-sm transition-colors duration-300"
                    aria-label="Toggle dark mode">
                    <svg
                      id="theme-toggle-dark-icon"
                      class="hidden w-5 h-5"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                    </svg>
                    <svg
                      id="theme-toggle-light-icon"
                      class="hidden w-5 h-5"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 5.05A1 1 0 003.636 6.464l.707.707a1 1 0 001.414-1.414l-.707-.707zM3 11a1 1 0 100-2H2a1 1 0 100 2h1zM6.464 14.364a1 1 0 001.414 1.414l.707-.707a1 1 0 00-1.414-1.414l-.707.707z" />
                    </svg>
                  </button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>

<script>
// Mobile search toggle functionality
document.getElementById('mobile-search-toggle').addEventListener('click', function() {
  const searchBar = document.getElementById('mobile-search-bar');
  const searchInput = document.getElementById('mobile-search-input');
  
  if (searchBar.classList.contains('hidden')) {
    searchBar.classList.remove('hidden');
    searchInput.focus();
  } else {
    searchBar.classList.add('hidden');
  }
});

// Desktop search clear button functionality
document.getElementById('desktop-search-input').addEventListener('input', function() {
  const clearBtn = document.getElementById('clear-desktop-search');
  if (this.value.length > 0) {
    clearBtn.style.display = 'flex';
  } else {
    clearBtn.style.display = 'none';
  }
});

// Handle search form submissions
document.querySelectorAll('form[action="/search"]').forEach(form => {
  form.addEventListener('submit', function(e) {
    const searchInput = this.querySelector('input[name="q"]');
    if (!searchInput.value.trim()) {
      e.preventDefault();
      searchInput.focus();
    }
  });
});

// Close mobile search when clicking outside
document.addEventListener('click', function(e) {
  const searchBar = document.getElementById('mobile-search-bar');
  const searchToggle = document.getElementById('mobile-search-toggle');
  
  if (!searchBar.contains(e.target) && !searchToggle.contains(e.target)) {
    searchBar.classList.add('hidden');
  }
});
</script>