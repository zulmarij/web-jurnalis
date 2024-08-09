<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{ seo()->render() }}

    @stack('head')

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="flex flex-col min-h-screen bg-white dark:bg-gray-900">
        <x-navbar />

        <main class="grow">
            {{ $slot }}
        </main>

        {{-- <x-footer /> --}}
    </div>

    @livewireScriptConfig
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>
