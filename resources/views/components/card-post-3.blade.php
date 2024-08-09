@props(['post'])
<article
    {{ $attributes->merge(['class' => 'p-4 mx-auto max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-800']) }}>
    <a href="/{{ $post->slug }}" wire:navigate>
        <img class="mb-5 rounded-lg object-cover h-44 w-full" src="{{ $post->image_url }}" alt="{{ $post->title }}">
    </a>
    <div class="flex items-center mb-3 space-x-2">
        <img class="w-8 h-8 rounded-full" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
        <div class="font-medium dark:text-white">
            <div>{{ $post->user->name }}</div>
            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                {{ $post->published_at?->format('d M Y') }}</div>
        </div>
    </div>
    <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 lg:text-2xl dark:text-white line-clamp-2">
        <a href="/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
    </h3>
    <p class="mb-3 font-light text-gray-500 dark:text-gray-400">
    <div class="line-clamp-3">
        {!! $post->body !!}
    </div>
    </p>
    <a href="/{{ $post->slug }}" wire:navigate
        class="inline-flex items-center font-medium text-primary-600 hover:text-primary-800 dark:text-primary-500 hover:no-underline">
        Read more
        <svg class="mt-px ml-1 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </a>
</article>
