<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
        ស្វែងរកតាម<span class="text-amber-500">ប្រភេទ</span>
      </h2>
      <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
      <p class="max-w-2xl mx-auto text-base text-gray-600 dark:text-gray-400">
        ស្វែងរកអ្វីដែលអ្នកត្រូវការបានយ៉ាងងាយស្រួល មិនថាជាទូរស័ព្ទមួយទឹកគុណភាពល្អ សេវាកម្មជួសជុល ឬគ្រឿង Accessories ផ្សេងៗ។
      </p>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">
      @foreach ($categories as $category)
      <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_categories[0]={{ $category->id}}" wire:key="{{ $category->id }}">
        <div class="p-4 md:p-5">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <img class="h-[5rem] w-[5rem]" src=" {{url ('storage', $category->image) }}" alt="{{ $category->name }}">
              <div class="ms-3">
                <h3 class="group-hover:text-blue-600 text-2xl font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                  {{ $category->name }}
                </h3>
              </div>
            </div>
            <div class="ps-3">
              <svg class="flex-shrink-0 w-5 h-5 text-gray-600 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </div>
          </div>
        </div>
      </a>
      @endforeach


    </div>
  </div>
</div>