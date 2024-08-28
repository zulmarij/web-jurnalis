@props(['posts', 'title'])

@if ($posts && $posts->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'border-t border-gray-900']) }}>
        <h2 class="text-2xl font-bold text-gray-900 my-4">{{ $title }}</h2>
        <div class="grid gap-4 divide-y lg:divide-x lg:divide-y-0 divide-gray-200 lg:grid-cols-12">

            <article class="flex flex-col lg:col-span-5">
                <a href="{{ route('post.show', ['slug' => $posts->first()->slug]) }}">
                    <x-media-display :post="$posts->first()" class="mb-4" />
                </a>
                <h2 class="my-2 text-2xl font-bold tracking-tight text-gray-900">
                    <a
                        href="{{ route('post.show', ['slug' => $posts->first()->slug]) }}">{{ $posts->first()->title }}</a>
                </h2>
                <p class="font-light text-gray-500">
                    {!! $posts->first()->excerpt() !!}
                </p>
            </article>

            <div class="space-y-4 pt-4 lg:pl-4 lg:py-0 divide-gray-200 divide-y lg:col-span-7">
                @foreach ($posts->slice(1) as $post)
                    @if ($loop->last)
                        <article class="pt-4">
                            <div>
                                <h2 class="mb-2 line-clamp-2 text-2xl font-bold tracking-tight text-gray-900">
                                    <a href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="font-light text-gray-500 line-clamp-3">{!! $post->excerpt() !!}</p>
                            </div>
                        </article>
                    @else
                        <article
                            class="flex sm:space-x-2 sm:flex-row flex-col-reverse @if ($loop->iteration === 2) pt-4 @endif">
                            <div class="sm:basis-8/12 lg:mt-0 mt-2">
                                <h2 class="mb-2 line-clamp-2 text-2xl font-bold tracking-tight text-gray-900">
                                    <a href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="font-light text-gray-500 line-clamp-3">{!! $post->excerpt() !!}</p>
                            </div>
                            <div class="sm:basis-4/12">
                                <x-media-display :post="$post" />
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
