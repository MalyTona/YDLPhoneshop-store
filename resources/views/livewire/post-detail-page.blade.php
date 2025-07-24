<div class="bg-white dark:bg-slate-900 font-sans py-12">
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                {{ $post->title }}
            </h1>
            <p class="mt-4 text-slate-500 dark:text-slate-400">
                Published on {{ $post->created_at->format('F d, Y') }}
            </p>
        </div>
        <img class="w-full h-auto rounded-2xl shadow-lg mb-8" src="{{ url('storage', $post->image) }}"
            alt="{{ $post->title }}">
        <div class=" text-slate-900 dark:text-white max-w-none">
            {!! $post->content !!}
        </div>
        <div class="mt-12">
            <a href="{{ route('blog') }}"
                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Blog
            </a>
        </div>
    </div>
</div>