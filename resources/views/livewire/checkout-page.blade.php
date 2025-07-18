<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        ការទូទាត់ | Checkout
    </h1>
    <form wire:submit.prevent='placeOrder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">

                    <div class="mb-6">
                        <h2 class="text-xl font-bold   text-gray-700 dark:text-white mb-2">
                            អាសយដ្ឋានដឹកជញ្ជូន | Shipping Address
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    នាមខ្លួន | First Name
                                </label>
                                <input wire:model='first_name' @error('first_name') border-red-500 @enderror
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="first_name" name="first_name" type="text">
                                @error('first_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    នាមត្រកូល | Last Name
                                </label>
                                <input wire:model='last_name'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="last_name" name="last_name" type="text">
                                @error('last_name')
                                    <div class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                លេខទូរស័ព្ទ | Phone
                            </label>
                            <input wire:model='phone'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="phone" name="phone" type="tel">
                            @error('phone')
                                <div class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-gray-200 mb-1" for="province">
                                ខេត្ត | Province
                            </label>
                            <select wire:model='province'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-gray-200 dark:border-none @error('province') border-red-500 @enderror"
                                id="province" name="province">
                                <option value="" disabled selected>ជ្រើសរើសខេត្ត | Select a Province</option>
                                <option value="Phnom Penh">ភ្នំពេញ | Phnom Penh</option>
                                <option value="Banteay Meanchey">បន្ទាយមានជ័យ | Banteay Meanchey</option>
                                <option value="Battambang">បាត់ដំបង | Battambang</option>
                                <option value="Kampong Cham">កំពង់ចាម | Kampong Cham</option>
                                <option value="Kampong Chhnang">កំពង់ឆ្នាំង | Kampong Chhnang</option>
                                <option value="Kampong Speu">កំពង់ស្ពឺ | Kampong Speu</option>
                                <option value="Kampong Thom">កំពង់ធំ | Kampong Thom</option>
                                <option value="Kampot">កំពត | Kampot</option>
                                <option value="Kandal">កណ្តាល | Kandal</option>
                                <option value="Kep">កែប | Kep</option>
                                <option value="Koh Kong">កោះកុង | Koh Kong</option>
                                <option value="Kratie">ក្រចេះ | Kratie</option>
                                <option value="Mondulkiri">មណ្ឌលគិរី | Mondulkiri</option>
                                <option value="Oddar Meanchey">ឧត្តរមានជ័យ | Oddar Meanchey</option>
                                <option value="Pailin">ប៉ៃលិន | Pailin</option>
                                <option value="Preah Sihanouk">ព្រះសីហនុ | Preah Sihanouk</option>
                                <option value="Preah Vihear">ព្រះវិហារ | Preah Vihear</option>
                                <option value="Prey Veng">ព្រៃវែង | Prey Veng</option>
                                <option value="Pursat">ពោធិ៍សាត់ | Pursat</option>
                                <option value="Ratanakiri">រតនគិរី | Ratanakiri</option>
                                <option value="Siem Reap">សៀមរាប | Siem Reap</option>
                                <option value="Stung Treng">ស្ទឹងត្រែង | Stung Treng</option>
                                <option value="Svay Rieng">ស្វាយរៀង | Svay Rieng</option>
                                <option value="Takeo">តាកែវ | Takeo</option>
                                <option value="Tboung Khmum">ត្បូងឃ្មុំ | Tboung Khmum</option>
                            </select>
                            @error('province')
                                <div class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-gray-200 mb-1" for="province">
                                ជ្រើសរើសក្រុមហ៊ុនដឹកជញ្ចួន
                            </label>
                            <select wire:model='shipping_method'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-gray-200 dark:border-none @error('province') border-red-500 @enderror"
                                id="province" name="province">
                                <option value="" disabled selected>ជ្រើសរើសក្រុមហ៊ុនដឹកជញ្ចួន | Select Shipping Method
                                </option>
                                <option value="VET Express">VET Express</option>
                                <option value="J&T Express">J&T Express</option>

                            </select>
                            @error('shipping_method')
                                <div class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-gray-200 mb-1" for="street_address">
                                អាសយដ្ឋានផ្លូវ | Street Address
                            </label>
                            <textarea wire:model="street_address"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-gray-200 dark:border-none @error('street_address') border-red-500 @enderror"
                                id="street_address" name="street_address" rows="3"></textarea>
                            @error('street_address')
                                <div class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                        ជ្រើសរើសវិធីសាស្ត្រទូទាត់
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model="payment_method" class="hidden peer" id="hosting-small" required
                                type="radio" value="bakong" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-400 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-small">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        ផ្ទេរប្រាក់តាម(ABA, ACLEDA)
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio"
                                value="stripe" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-400 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-big">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Stripe
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </label>
                        </li>
                    </ul>
                    @error('payment_method')
                        <div class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">

                    <div class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-2">
                        សង្ខេបការបញ្ជាទិញ
                    </div>
                    <div class="flex justify-between mb-2 font-bold text-gray-700 dark:text-gray-200">
                        <span>Taxes</span>
                        <span>{{ Number::currency(0, 'USD') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold text-gray-700 dark:text-gray-200">
                        <span>Shipping (Cambodia Local)</span>
                        <span>{{ Number::currency(1.50, 'USD') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold text-gray-700 dark:text-gray-200">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'USD') }}</span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold text-gray-700 dark:text-gray-200">
                        <span>Grand Total</span>
                        <span>{{ Number::currency($grand_total, 'USD') }}</span>
                    </div>

                    <div class="mt-5 space-y-4">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <span wire:loading.remove>ដាក់បញ្ជាទិញ</span>
                            <span wire:loading>កំពុងដាក់បញ្ជាទិញ...</span>
                        </button>
                        <a href="/products"
                            class="block w-full text-center py-3 px-6 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-gray-400 dark:hover:border-gray-500 font-medium rounded-xl transition-colors duration-200">
                            បន្តការទិញទំនិញ
                        </a>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 mt-6 pt-6">
                        <div class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-2">
                            សង្ខេបកន្ត្រក
                        </div>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                            @foreach ($cart_items as $ci)
                                <li class="py-3 sm:py-4" wire:key='{{ $ci["product_id"] }}'>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img alt="{{ $ci['name'] }}" class="w-12 h-12 rounded-full"
                                                src="{{ url('storage', $ci['image']) }}">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">
                                                {{ $ci['name'] }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                QTY : {{ $ci['quantity'] }}
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-gray-200">
                                            {{ Number::currency($ci['total_amount'], 'USD') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    </form>
</div>