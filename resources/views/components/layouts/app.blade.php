@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/' . $settings->site_favicon) }}" type="image/x-icon">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    @stack('head')

    @livewireStyles
    @vite('resources/css/app.css')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3WXYWRH2X"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Y3WXYWRH2X');
    </script>
</head>

<body class="antialiased">
    <div class="flex flex-col min-h-screen bg-white dark:bg-gray-900">
        <x-header />

        <main class="grow">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    @livewireScriptConfig
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>
