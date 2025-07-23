<div class="w-full max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight sm:text-4xl">គណនីរបស់ខ្ញុំ
        </h1>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 text-sm font-medium text-green-800 bg-green-50 dark:bg-green-900/30 dark:text-green-300 rounded-lg shadow-sm transition-opacity duration-300"
            role="alert" aria-live="polite">
            <span class="font-semibold">Success!</span> {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Profile Information Column -->
        <div
            class="bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form wire:submit.prevent="updateProfile" class="space-y-6">
                    <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-200">ព័ត៌មានផ្ទាល់ខ្លួន</h2>
                    {{-- Name Field --}}
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Name</label>
                        <input wire:model.defer="name" type="text" name="name" id="name" autocomplete="name"
                            class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 py-2.5 px-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 ease-in-out"
                            aria-describedby="name-error">
                        @error('name')
                            <span id="name-error" class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email
                            Address</label>
                        <input wire:model.defer="email" type="email" name="email" id="email" autocomplete="email"
                            class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700/70 text-slate-500 dark:text-slate-400 py-2.5 px-4 text-sm cursor-not-allowed shadow-sm focus:ring-0"
                            disabled readonly aria-describedby="email-error">
                    </div>

                    {{-- Phone Field --}}
                    <div>
                        <label for="phone"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Phone</label>
                        <input wire:model.defer="phone" type="tel" name="phone" id="phone" autocomplete="tel"
                            class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 py-2.5 px-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 ease-in-out"
                            aria-describedby="phone-error">
                        @error('phone')
                            <span id="phone-error" class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2.5 px-6 rounded-lg bg-amber-600 text-white text-sm font-semibold shadow-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200 ease-in-out"
                            aria-label="Save profile changes">
                            កែប្រែ
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Column -->
        <div
            class="bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form wire:submit.prevent="changePassword" class="space-y-6">
                    <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-200">ផ្លាស់ប្តូរពាក្យសម្ងាត់</h2>
                    {{-- Current Password --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="current_password"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">Current
                                Password</label>
                            <a href="/forgot-password" wire:navigate
                                class="text-xs text-amber-600 hover:underline dark:text-amber-500">
                                ភ្លេចពាក្យសម្ងាត់ឬ?
                            </a>
                        </div>
                        <div class="relative">
                            <input wire:model.defer="current_password" type="password" name="current_password"
                                id="current_password"
                                class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 py-2.5 px-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 ease-in-out">
                            <button type="button" data-hs-toggle-password='{"target": "#current_password"}'
                                class="absolute top-0 end-0 p-3.5 rounded-e-md">
                                <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:hidden"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path
                                        d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                    </path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                    </path>
                                    <line x1="2" x2="22" y1="2" y2="22"></line>
                                </svg>
                                <svg class="hidden flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:block"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="new_password"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">New
                            Password</label>
                        <div class="relative">
                            <input wire:model.defer="new_password" type="password" name="new_password" id="new_password"
                                class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 py-2.5 px-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 ease-in-out">
                            <button type="button" data-hs-toggle-password='{"target": "#new_password"}'
                                class="absolute top-0 end-0 p-3.5 rounded-e-md">
                                <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:hidden"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path
                                        d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                    </path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                    </path>
                                    <line x1="2" x2="22" y1="2" y2="22"></line>
                                </svg>
                                <svg class="hidden flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:block"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('new_password')
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm New Password --}}
                    <div>
                        <label for="new_password_confirmation"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Confirm New
                            Password</label>
                        <div class="relative">
                            <input wire:model.defer="new_password_confirmation" type="password"
                                name="new_password_confirmation" id="new_password_confirmation"
                                class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 py-2.5 px-4 text-sm shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 ease-in-out">
                            <button type="button" data-hs-toggle-password='{"target": "#new_password_confirmation"}'
                                class="absolute top-0 end-0 p-3.5 rounded-e-md">
                                <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:hidden"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path
                                        d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                    </path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                    </path>
                                    <line x1="2" x2="22" y1="2" y2="22"></line>
                                </svg>
                                <svg class="hidden flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600 hs-password-active:block"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2.5 px-6 rounded-lg bg-blue-600 text-white text-sm font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200 ease-in-out"
                            aria-label="Change password">
                            ប្តូរពាក្យសម្ងាត់
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>