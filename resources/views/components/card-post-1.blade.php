@props(['post'])


<article class="max-w-xs">
    <a href="/{{ $post->slug }}" wire:navigate>
        <img src="{{ $post->image_url }}" class="mb-5 rounded-lg object-cover h-44 w-full" alt="{{ $post->title }}">
    </a>
    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white line-clamp-2">
        <a href="/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
    </h2>
    <p class="mb-4 font-light text-gray-500 dark:text-gray-400">
    <div class="line-clamp-3">
        {!! $post->body !!}
    </div>
    </p>
    {{-- <a href="/{{ $post->slug }}" wire:navigate
        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
        Read in 2 minutes
    </a> --}}
</article>
