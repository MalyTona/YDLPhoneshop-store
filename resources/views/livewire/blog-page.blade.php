<div class="bg-slate-50 dark:bg-slate-900 font-sans">
    <div class="w-full max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Our <span class="text-blue-600">Blog</span>
            </h1>
            <p class="mt-4 mb-4 max-w-2xl mx-auto text-lg text-slate-600 dark:text-slate-300">
                ព័ត៌មានថ្មីៗ គន្លឹះនិងចំណេះដឹង ពីពិភពបច្ចេកវិទ្យា សម្រាប់អតិថិជន YDL Phone Shop.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($posts as $post)
                <div wire:key="{{ $post->id }}"
                    class="bg-white dark:bg-slate-800/50 rounded-2xl shadow-lg overflow-hidden flex flex-col">
                    <a href="{{ route('post.detail', $post->slug) }}">
                        <img class="w-full h-48 object-cover" src="{{ url('storage', $post->image) }}"
                            alt="{{ $post->title }}">
                    </a>
                    <div class="p-6 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">
                            <a href="{{ route('post.detail', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 line-clamp-3">
                            {{ strip_tags($post->content) }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('post.detail', $post->slug) }}"
                                class="font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500">
                                Read More &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 px-6 bg-white dark:bg-slate-800/50 rounded-2xl">
                    <p class="text-slate-500 dark:text-slate-400">No blog posts have been published yet.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>