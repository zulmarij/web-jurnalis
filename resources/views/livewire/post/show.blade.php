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

        <x-media-display :post="$this->post" class="mb-4"/>

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

        <section class="not-format" id="comments">
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
            {{-- <article
                class="p-6 mb-6 text-base bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <img class="mr-2 w-8 h-8 rounded-lg"
                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Michael Gough">
                        <div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Michael Gough</span>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400"><time pubdate
                                    datetime="2022-02-08" title="February 8th, 2022">Feb. 8, 2022</time></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            37
                        </button>
                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment1"
                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownComment1Button">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">Very straight-to-point article. Really worth time reading.
                    Thank you! But tools are just the instruments for the UX designers. The knowledge of the design
                    tools are as important as the creation of the design strategy.</p>
                <button type="button" class="mt-4 text-sm text-gray-900 hover:underline dark:text-white">
                    Reply
                </button>
            </article>
            <article
                class="p-6 mb-6 ml-6 text-base bg-white rounded-lg border border-gray-200 shadow-sm lg:ml-12 dark:bg-gray-800 dark:border-gray-700">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <img class="mr-2 w-8 h-8 rounded-lg"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Jese Leos">
                        <div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Jese Leos</span>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400"><time pubdate
                                    datetime="2022-02-12" title="February 12th, 2022">Feb. 12, 2022</time></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            9
                        </button>
                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment2"
                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownComment1Button">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">Much appreciated! Glad you liked it ☺️</p>
                <button type="button" class="mt-4 text-sm text-gray-900 hover:underline dark:text-white">
                    Reply
                </button>
            </article>
            <article
                class="p-6 mb-6 text-base bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <img class="mr-2 w-8 h-8 rounded-lg"
                            src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie Green">
                        <div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</span>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400"><time pubdate
                                    datetime="2022-03-12" title="March 12th, 2022">Mar. 12, 2022</time></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            22
                        </button>
                        <button id="dropdownComment3Button" data-dropdown-toggle="dropdownComment3"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment3"
                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownComment3Button">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">The article covers the essentials, challenges, myths and
                    stages the UX designer should consider while creating the design strategy.</p>
                <button type="button" class="mt-4 text-sm text-gray-900 hover:underline dark:text-white">
                    Reply
                </button>
            </article>
            <article
                class="p-6 text-base bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <img class="mr-2 w-8 h-8 rounded-lg"
                            src="https://flowbite.com/docs/images/people/profile-picture-4.jpg" alt="Helene Engels">
                        <div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Helene Engels</span>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400"><time pubdate
                                    datetime="2022-06-23" title="June 23rd, 2022">Jun. 23, 2022</time></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            18
                        </button>
                        <button id="dropdownComment4Button" data-dropdown-toggle="dropdownComment4"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment4"
                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownComment4Button">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">Thanks for sharing this. I do came from the Backend
                    development and explored some of the tools to design my Side Projects.</p>
                <button type="button" class="mt-4 text-sm text-gray-900 hover:underline dark:text-white">
                    Reply
                </button>
            </article> --}}
        </section>
    </article>
    <aside class="hidden xl:block xl:w-[336px]" aria-labelledby="sidebar-label">
        <h3 id="sidebar-label" class="sr-only">Sidebar</h3>
        <div
            class="p-5 mb-6 font-medium text-gray-500 bg-white rounded-lg border border-gray-200 divide-y divide-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:divide-gray-700">
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
        <div class="p-5 mb-6 bg-white rounded-lg border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
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
        </div>

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

        </div>
    </aside>
</section>
