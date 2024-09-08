<section class="flex justify-between max-w-screen-xl p-4 mx-auto">
    <article
        class="w-full max-w-none xl:w-[828px] format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <header class="mb-4 lg:mb-6 not-format">
            {{ Breadcrumbs::render('post', $this->post) }}
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
                <a href="#comments"
                    class="flex items-center text-sm font-medium shrink-0 text-primary-600 dark:text-primary-500 hover:underline">
                    <svg class="mr-1 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    {{ $this->post->comments->count() }} Comments
                </a>
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

        {{-- <section class="not-format" id="comments">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900 lg:text-2xl dark:text-white">Leave a reply</h2>
            </div>
            <form action="#">
                <div class="mb-4">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your
                        message</label>
                    <textarea id="message" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder=""></textarea>
                </div>
                <button type="submit"
                    class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Post
                    comment</button>
            </form>
        </section> --}}
    </article>
    <aside class=" hidden xl:block xl:w-[336px]" aria-labelledby="sidebar-label">
        <h3 id="sidebar-label" class="sr-only">Sidebar</h3>
        <div
            class="p-5 mb-6 font-medium text-gray-500 bg-white rounded-lg border border-gray-200 divide-y divide-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:divide-gray-700 sticky top-20">
            <h4 class="mb-4 text-sm font-bold text-gray-900 uppercase dark:text-white">Latest news</h4>
            @foreach ($this->latestPosts as $post)
                <div class="flex items-center py-4">
                    <a href="/{{ $post->slug }}" wire:navigate class="shrink-0">
                        <x-media-display :post="$post" class="h-14  mr-4" :showControls="false" />
                    </a>
                    <a href="/{{ $post->slug }}" wire:navigate>
                        <h5
                            class="font-semibold leading-tight text-gray-900 dark:text-white hover:underline line-clamp-3">
                            {{ $post->title }}
                        </h5>
                    </a>
                </div>
            @endforeach

        </div>
        {{-- <div class="p-5 mb-6 bg-white rounded-lg border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
            <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">
                Get the best of News delivered to your inbox
            </h4>
            <p class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">Subscribe our newsletter for latest
                world news. Let's stay updated!
            </p>
            <form action="#">
                <label for="name-icon" class="sr-only">Your Email</label>
                <div class="relative mb-4">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input required type="text" id="name-icon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Your name">
                </div>
                <div class="relative mb-4">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <input required type="email" id="email-address-icon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="name@company.com">
                </div>
                <button type="submit"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 text-center w-full">Subscribe</button>
            </form>
        </div> --}}
{{--
        <div
            class="p-5 mb-6 font-medium text-gray-500 bg-white rounded-lg border border-gray-200 divide-y divide-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:divide-gray-700">
            <h4 class="mb-4 text-sm font-bold text-gray-900 uppercase dark:text-white">Recent comments</h4>
            @foreach ($this->latestComments as $comment)
                <div class="py-4">
                    <p class="font-light text-gray-500 dark:text-gray-400">{{ $comment->user->name }}
                        on
                        <a href=" {{ $comment->post->slug }}" wire:navigate
                            class="italic font-medium text-gray-900 dark:text-white hover:underline">
                            {{ $comment->post->title }}
                        </a>
                    </p>
                </div>
            @endforeach

        </div> --}}
    </aside>
</section>
