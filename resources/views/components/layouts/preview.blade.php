<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('head')

    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="flex flex-col min-h-screen bg-white dark:bg-gray-900">
        <main class="grow">
            {{ $slot }}
        </main>
    </div>

    @livewireScriptConfig
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>
