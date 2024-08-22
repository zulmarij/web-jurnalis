<section class="max-w-screen-xl p-4 mx-auto">
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($this->posts as $key => $post)
            <article
                class="p-4 bg-white rounded-lg border
                border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
                wire:key="post-{{ $key }}">
                <a href="/{{ $post->slug }}" wire:navigate>
                    <x-media-display :post="$post" class="mb-5" />
                </a>
                @foreach ($post->categories as $category)
                    <a href="#">
                        <span
                            class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-900">
                            {{ $category->name }}</span>
                    </a>
                @endforeach
                <h2 class="my-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">
                    <a href="/{{ $post->slug }}" wire:navigate>{!! $post->title !!}</a>
                </h2>
                <p class="mb-4 font-light text-gray-500 dark:text-gray-400 line-clamp-3">
                    {!! $post->excerpt() !!}
                </p>
                <div class="flex items-center space-x-4">
                    <img class="w-10 h-10 rounded-full" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                    <div class="font-medium dark:text-white">
                        <div>{{ $post->user->name }}</div>
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            {{ $post->published_at?->format('d M Y') }} · {{ $post->read_time }} min read
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    @if ($this->hasMore())
        <div class="flex justify-center mt-8">
            <button wire:click="loadMore"
                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-600"
                wire:loading.attr="disabled">
                <span wire:loading>
                    Loading...
                </span>
                <span wire:loading.remove>
                    Load More
                </span>

            </button>
        </div>
    @endif
    {{-- @if ($this->hasMore())
            <div class="self-center loading loading-spinner" x-intersect="$wire.loadMore()"></div>
        @endif --}}
</section>
