@php
    $settings = app(\App\Settings\GeneralSettings::class);
    $siteLogo = $settings->site_logo;
    $siteName = $settings->site_name;
@endphp

<footer class="p-4 bg-white sm:p-6 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl">
        <div class="flex mb-6">
            <a href="/" wire:navigate class="flex items-center">
                <img src="{{ asset('storage/' . $siteLogo) }}" class="mr-3 h-8" alt="{{ $siteName }}" />
                <span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $siteName }}</span>
            </a>
        </div>
        <div class="md:flex md:justify-between">
            <div class="grid grid-cols-1 gap-8 xs:gap-6 sm:grid-cols-2">
                <div>
                    <ul class="space-y-4 font-semibold">
                        <li>
                            <a href="#" class="hover:underline">FAQs</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-4 font-semibold text-gray-900 uppercase dark:text-white">About Us</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Telp: +62 812 1234 1234
                        </li>
                        <li class="flex items-center">
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            Email: <a href="mailto:hmg@thestance.id" class="ml-2 hover:underline">hmg@thestance.id</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="mt-6 md:mt-0">
                <h2 class="mb-4 font-semibold text-gray-900 uppercase dark:text-white">About Us</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Telp: +62 812 1234 1234
                    </li>
                    <li class="flex items-center">
                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Email: <a href="mailto:hmg@thestance.id" class="ml-2 hover:underline">hmg@thestance.id</a>
                    </li>
                </ul>
            </div> --}}
        </div>
        <hr class="my-6 border-gray-200 border-dotted sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <span class="text-sm text-gray-500 lg:text-center dark:text-gray-400  lg:order-1 order-2">©
                {{ date('Y') }} <a href="https://flowbite.com" class="hover:underline">{{ $siteName }}</a>. All
                Rights Reserved.
            </span>
            <div class="flex mb-4 space-x-2 sm:space-x-6 lg:justify-center lg:mb-0 lg:order-2 order-1">
                <span class="text-sm font-semibold">
                    Connnect:
                </span>
                <div class="flex flex-wrap gap-2 sm:gap-x-6">
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        Instagram
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        LinkedIn
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        Twitter
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        Facebook
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        YouTube
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        TikTok
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
