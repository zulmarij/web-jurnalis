<section class="max-w-screen-xl p-4 mx-auto">
    <div class="grid mb-6 gap-8 lg:divide-x lg:divide-gray-200 dark:lg:divide-gray-700 lg:grid-cols-3">
        <x-card-post :post="$featuredPosts[0]" :displayReadMore="false" />

        <div class="space-y-8 lg:pl-8">
            @foreach ($featuredPosts->slice(1, 2) as $post)
                <x-card-post :post="$post" :displayImage="false" />
            @endforeach
        </div>

        <div class="space-y-8 lg:pl-8">
            @foreach ($featuredPosts->slice(3, 2) as $post)
                <x-card-post :post="$post" :displayImage="false" />
            @endforeach
        </div>
    </div>

    <div class="mb-16">
        {{-- <h2 class="mb-6 lg:mb-8 text-2xl font-bold text-gray-900 dark:text-white">News</h2> --}}
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($posts as $post)
                <x-card-post-1 :post="$post" />
            @endforeach
        </div>
    </div>

    <div class="mb-16">
        <h2 class="mb-6 lg:mb-8 text-2xl font-bold text-gray-900 dark:text-white">News</h2>
        <div class="grid gap-6 lg:gap-12 md:grid-cols-2">
            @foreach ($posts as $post)
                <x-card-post-2 :post="$post" />
            @endforeach
        </div>
    </div>

    <div class="mb-16">
        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Trending</h2>
        <div id="animation-carousel" data-carousel="slide">
            <div class="relative overflow-hidden rounded-lg h-[460px]">
                @php
                    $chunks = $carouselPosts->chunk(3);
                @endphp
                @foreach ($chunks as $chunk)
                    <div class="hidden bg-white duration-700 ease-in-out dark:bg-gray-900" data-carousel-item>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach ($chunk as $index => $post)
                                @php
                                    $class = '';
                                    if ($index === 1) {
                                        $class = 'hidden sm:block';
                                    } elseif ($index === 2) {
                                        $class = 'hidden xl:block';
                                    }
                                @endphp
                                <x-card-post-3 :post="$post" :class="$class" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
