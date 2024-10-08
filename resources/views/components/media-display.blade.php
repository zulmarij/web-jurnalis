@props([
    'post',
    'showControls' => true,
    'showCaption' => false,
    'imageClass' => '',
    'aspectClass' => 'aspect-video',
])

<div {{ $attributes->merge(['class' => $aspectClass]) }}>
    @php
        $mediaType = $post->media->type;
        $mediaCaption = $post->media->caption;
    @endphp

    @if (str_contains($mediaType, 'image'))
        <img class="rounded-lg object-cover h-full w-full {{ $imageClass }}" src="{{ $post->media_url }}"
            alt="{{ $post->title ?? 'Image' }}">
    @elseif (str_contains($mediaType, 'video'))
        <video class="rounded-lg object-cover h-full w-full" {{ $showControls ? 'controls' : '' }}>
            <source src="{{ $post->media_url }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif

</div>
@if ($mediaCaption && $showCaption)
    <small class="block -mt-4">{{ $mediaCaption }}</small>
@endif
