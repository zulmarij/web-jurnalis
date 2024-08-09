@props(['post'])

<article class="flex flex-col xl:flex-row">
    <a href="/{{ $post->slug }}" wire:navigate class="mb-2 xl:mb-0">
        <img src="{{ $post->image_url }}" class="mr-5 max-w-sm object-cover h-44" alt="{{ $post->title }}">
    </a>
    <div class="flex flex-col justify-center">
        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white line-clamp-2">
            <a href="/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
        </h2>
        <p class="mb-4 font-light text-gray-500 dark:text-gray-400 max-w-sm">
        <div class="line-clamp-4">
            {!! $post->body !!}
        </div>
        </p>
        <a href="/{{ $post->slug }}" wire:navigate class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
            Read more
        </a>
    </div>
</article>
