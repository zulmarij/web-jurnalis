@php
    $settings = app(\App\Settings\GeneralSettings::class);
    $siteLogo = $settings->site_logo;
    $siteName = $settings->site_name;
@endphp

<nav class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        <a href="/" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/' . $siteLogo) }}" class="h-8" alt="{{ $siteName }}" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $siteName }}</span>
        </a>
    </div>
</nav>



