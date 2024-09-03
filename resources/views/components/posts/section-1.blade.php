@props(['posts'])

<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($posts as $key => $post)
        <article
            class="p-4 bg-white rounded-lg border
            border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
            wire:key="post-{{ $key }}">
            <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
                <x-media-display :post="$post" class="mb-5" />
            </a>
            <a href="{{ route('posts-by-category', ['slug' => $post->firstCategory()->slug]) }}">
                <span
                    class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-900">
                    {{ $post->firstCategory()->name }}</span>
            </a>
            <h2 class="my-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">
                <a href="{{ route('post.show', ['slug' => $post->slug]) }}">{!! $post->title !!}</a>
            </h2>
            <p class="mb-4 font-light text-gray-500 dark:text-gray-400 line-clamp-3">
                {!! $post->sub_title ?? $post->excerpt() !!}
            </p>
            {{-- <div class="flex items-center space-x-4">
                <a href="{{ route('posts-by-author', ['username' =>$post->user->username ]) }}">
                    <img class="w-10 h-10 rounded-full" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                </a>
                <div class="font-medium dark:text-white">
                    <a href="{{ route('posts-by-author', ['username' => $post->user->username ]) }}">
                        {{ $post->user->name }}
                    </a>
                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        {{ $post->published_at?->format('d M Y') }} · {{ $post->read_time }} min read
                    </div>
                </div>
            </div> --}}
        </article>
    @endforeach
</div>
