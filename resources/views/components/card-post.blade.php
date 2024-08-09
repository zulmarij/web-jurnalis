@props(['post', 'displayImage' => true, 'displayReadMore' => true])

<article>
    @if ($displayImage)
        <a href="/{{ $post->slug }}" wire:navigate>
            <img class="object-cover w-full mb-5 rounded-lg h-44" src="{{ $post->image_url }}" alt="{{ $post->title }}">
        </a>
    @endif
    <h2 class="my-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">
        <a href="/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
    </h2>
    <p class="mb-4 font-light text-gray-500 dark:text-gray-400">
    <div class="line-clamp-3">
        {!! $post->body !!}
    </div>
    </p>
    @if ($displayReadMore)
        <a href="/{{ $post->slug }}" wire:navigate
            class="inline-flex items-center font-medium text-primary-600 hover:underline dark:text-primary-500">
            Read more
            <x-heroicon-o-arrow-right class="w-4 h-4 ml-2" />
        </a>
    @endif
</article>
