@props(['post'])

<div class="bg-gray-50 dark:bg-gray-800 p-8 mb-8 text-center">
    <div class="max-w-screen-xl mx-auto">
        <a href="{{ route('posts-by-category', ['slug' => $post->firstCategory()->slug]) }}"
            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
            {{ $post->firstCategory()->name }}
        </a>
        <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
            <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2">
                {!! $post->title !!}
            </h1>
            <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-6">
                {!! $post->sub_title ?? $post->excerpt() !!}
            </p>
            <x-media-display :post="$post" imageClass="object-fill" aspectClass="aspect-auto" />
        </a>
    </div>
</div>
