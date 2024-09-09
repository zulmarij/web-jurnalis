<div class="flex justify-center max-w-screen-xl p-4 mx-auto">
    <article
        class="w-full max-w-none xl:w-[828px] format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <header class="mb-4 lg:mb-6 not-format">
            {{ Breadcrumbs::render('preview', $this->post) }}
            <h1 class="my-4 text-2xl font-extrabold leading-tight text-gray-900 lg:my-6 lg:text-4xl dark:text-white">
                {{ $this->post->title }}
            </h1>
            <p class="mb-4 font-light text-gray-900 dark:text-gray-400">
                {!! $this->post->sub_title !!}
            </p>
            <div class="flex justify-between items-center py-4 border-t border-b border-gray-200 dark:border-gray-700">
                <div class="mr-4 text-sm">
                    <address class="inline not-italic">
                        By
                        <a rel="author" class="text-gray-900 no-underline dark:text-white hover:underline"
                            href="{{ route('posts-by-author', ['username' => $this->post->user->username]) }}">
                            {{ $this->post->user->name }}
                        </a>
                    </address>
                    in
                    <a href="{{ route('posts-by-category', ['slug' => $this->post->firstCategory()->slug]) }}"
                        class="text-gray-900 no-underline dark:text-white hover:underline">
                        {{ $this->post->firstCategory()->name }}
                    </a>
                    <span>
                        on
                        <time pubdate class="uppercase" datetime="{{ $this->post->published_at?->format('Y-m-d') }}"
                            title="{{ $this->post->published_at?->format('d M Y') }}">
                            {{ $this->post->published_at?->format('d M Y') }}
                        </time>
                    </span>
                </div>
            </div>
        </header>

        <x-media-display :post="$this->post" class="mb-4" showCaption />

        <div class="text-gray-900">
            {!! tiptap_converter()->asHtml($this->post->body) !!}
        </div>

        <div class="flex flex-wrap items-center my-4 md:my-6 gap-3 not-format">
            @foreach ($this->post->tags as $tag)
                <a href="{{ route('posts-by-tag', ['slug' => $tag->slug]) }}"
                    class="bg-primary-100 dark:hover:bg-primary-300 text-primary-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 hover:bg-primary-200">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </article>
</div>
