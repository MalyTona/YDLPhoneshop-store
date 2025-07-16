<div class="w-full max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight sm:text-4xl">My Account
        </h1>
    </div>

    <div
        class="bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 sm:p-8">
            @if (session()->has('message'))
                <div class="mb-6 p-4 text-sm font-medium text-green-800 bg-green-50 dark:bg-green-900/30 dark:text-green-300 rounded-lg shadow-sm transition-opacity duration-300"
                    role="alert" aria-live="polite">
                    <span class="font-semibold">Success!</span> {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="updateProfile" class="space-y-6">
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
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email
                        Address</label>
                    <input wire:model.defer="email" type="email" name="email" id="email" autocomplete="email"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700/70 text-slate-500 dark:text-slate-400 py-2.5 px-4 text-sm cursor-not-allowed shadow-sm focus:ring-0"
                        disabled readonly aria-describedby="email-error">
                    @error('email')
                        <span id="email-error" class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                    <button type="submit"
                        class="inline-flex justify-center py-2.5 px-6 rounded-lg bg-amber-600 text-white text-sm font-semibold shadow-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200 ease-in-out"
                        aria-label="Save profile changes">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>