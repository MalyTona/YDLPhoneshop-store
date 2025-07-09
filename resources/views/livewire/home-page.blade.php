<div>
   @livewire('hero-slider')
  <!-- Brand Section -->
  <section class="bg-gray-50 dark:bg-slate-900 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
          ម៉ាកទូរស័ព្ទ<span class="text-amber-500">ពេញនិយម</span>
        </h2>
        <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
        <p class="max-w-2xl mx-auto text-base text-gray-600 dark:text-gray-400">
          យើងមានលក់ទូរស័ព្ទដៃស្មាតហ្វូនពីបណ្តាម៉ាកល្បីៗជាច្រើន។ ស្វែងរកម៉ាកដែលអ្នកពេញចិត្តខាងក្រោម។
        </p>
      </div>

      <div class="mt-12 grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">
        @foreach ($brands as $brand)
        <a href="/products?seclected_brands[0]={{ $brand->id}}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg brand-card" wire:key="{{ $brand->id }}">
          <div class="h-32 sm:h-40 flex items-center justify-center p-4 bg-gray-100 dark:bg-gray-700/50">
            <img src="{{ url ('storage', $brand->image) }}" alt="{{ $brand->name }} Logo" class="h-16 sm:h-20 object-contain">
          </div>
          <div class="p-3 text-center">
            <h3 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-gray-200">{{ $brand->name }}</h3>
          </div>
        </a>
        @endforeach
      </div>
     

    </div>
  </section>

  <!-- Category Section -->
  <section class="bg-white dark:bg-slate-900 py-12 sm:py-16 lg:py-20">
    <div class="max-w-xl mx-auto">
      <div class="text-center">
        <div class="relative flex flex-col items-center">
          <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
            ស្វែងរកតាម<span class="text-amber-500">ប្រភេទ</span>
          </h2>
          <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
        </div>
        <p class="max-w-2xl mx-auto text-base text-gray-600 dark:text-gray-400">
          ស្វែងរកអ្វីដែលអ្នកត្រូវការបានយ៉ាងងាយស្រួល មិនថាជាទូរស័ព្ទមួយទឹកគុណភាពល្អ សេវាកម្មជួសជុល ឬគ្រឿងបន្លាស់ផ្សេងៗ។
        </p>
      </div>
    </div>
    <div class="max-w-6xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach ($categories as $category)
        <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-lg transition dark:bg-slate-800 dark:border-gray-700" href="/products?selected_categories[0]={{ $category->id}}" wire:key="{{ $category->id }}">
          <div class="p-4 md:p-5">
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <img class="h-14 w-14  object-cover" src="{{url('storage', $category->image)}}" alt="{{ $category->name}}">
                <div class="ms-4">
                  <h3 class="group-hover:text-amber-500 font-semibold text-gray-800 dark:text-gray-200">
                    {{ $category->name}}
                  </h3>
                </div>
              </div>
              <div class="ps-3">
                <img src="https://cdn-icons-png.flaticon.com/512/130/130884.png" alt="Go to category" class="w-5 h-5 dark:invert">
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>
            <!-- Google Map -->
             <section class="bg-gray-50 dark:bg-slate-800 py-16 sm:py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
        ទីតាំង<span class="text-amber-500">ហាងយើង</span>
      </h2>
      <div class="mt-2 mb-4 h-1 w-32 mx-auto bg-gradient-to-r from-amber-400 to-blue-500 rounded-full"></div>
      <p class="max-w-2xl mx-auto text-base text-gray-600 dark:text-gray-400">
        សូមអញ្ជើញមកទស្សនាហាងយើងដើម្បីទទួលបានសេវាកម្មដ៏ល្អបំផុត និងផលិតផលគុណភាពខ្ពស់
      </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
      <!-- Contact Information -->
      <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg p-8 order-2 lg:order-1">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">ព័ត៌មានទំនាក់ទំនង</h3>
        <div class="space-y-6">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 dark:text-white">អាសយដ្ឋាន</h4>
              <p class="text-gray-600 dark:text-gray-400">និគមលើ, ស្រឡប់, ខេត្តត្បូងឃ្មុំ</p>
            </div>
          </div>

          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 dark:text-white">លេខទូរស័ព្ទ</h4>
              <p class="text-gray-600 dark:text-gray-400">+855 96 684 4498</p>
              <p class="text-gray-600 dark:text-gray-400">+855 71 600 8881</p>
            </div>
          </div>

          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 dark:text-white">ម៉ោងបើកទ្វារ</h4>
              <p class="text-gray-600 dark:text-gray-400">ចន្ទ - អាទិត្យ: 8:00 AM - 8:00 PM</p>
            </div>
          </div>

          <div class="pt-4">
            <a href="https://t.me/Yoth_Dalen" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
              </svg>
              ទំនាក់ទំនងតាម Telegram
            </a>
          </div>
        </div>
      </div>

      <!-- Google Map -->
      <div class="order-1 lg:order-2">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden h-full">
          <div class="relative w-full h-96 lg:h-full min-h-[500px]">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d244.00939069536986!2d105.80145520137164!3d11.894624119961234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2skh!4v1751950619240!5m2!1sen!2skh" 
              width="100%" 
              height="100%" 
              style="border:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
              title="YDLPhoneShop Location">
            </iframe>
          </div>
        </div>
      </div>
    </div>

    <!--  Directions Button -->
    <div class="text-center mt-8">
      <a href="https://maps.app.goo.gl/hMNkK4VozfFg82KWA" target="_blank" class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg transition-colors duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
        </svg>
        ទទួលបានទិសដៅ (Get Directions)
      </a>
    </div>
  </div>
</section>
</div>