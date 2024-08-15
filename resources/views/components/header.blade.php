@php
    $settings = app(\App\Settings\GeneralSettings::class);
    $siteLogo = $settings->site_logo;
    $siteName = $settings->site_name;
@endphp

<header class="mb-16">
    <nav class="bg-white dark:bg-gray-800 fixed w-full z-40 top-0 start-0">
        <div class="max-w-screen-xl p-4 mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <div class="shrink-0">
                        <a href="/" wire:navigate title="{{ $siteName }}" class="">
                            <img class="block w-auto h-8"
                                src="{{ asset('storage/' . $siteLogo) }}"alt="{{ $siteName }}">
                        </a>
                    </div>
                    <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                        <li>
                            <a href="#" title=""
                                class="flex font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                                Finance
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="#" title=""
                                class="flex font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                                Sport
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="#" title=""
                                class="flex font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                                Special Program
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="flex items-center lg:space-x-2">
                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                        class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium leading-none text-gray-900 dark:text-white">
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Account
                        <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="userDropdown1"
                        class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                        <ul class="p-2 text-start  font-medium text-gray-900 dark:text-white">
                            <li><a href="#" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2  hover:bg-gray-100 dark:hover:bg-gray-600">
                                    My Account </a></li>
                        </ul>

                        <div class="p-2  font-medium text-gray-900 dark:text-white">
                            <a href="#" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2  hover:bg-gray-100 dark:hover:bg-gray-600">
                                Sign Out </a>
                        </div>
                    </div>

                    <button type="button" data-collapse-toggle="navbar-menu-1" aria-controls="navbar-menu-1"
                        aria-expanded="false"
                        class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                        <span class="sr-only">
                            Open Menu
                        </span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M5 7h14M5 12h14M5 17h14" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-menu-1"
                class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
                <ul class="text-gray-900 dark:text-white  font-medium space-y-3">
                    <li>
                        <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Finance</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Sport</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Special Program</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
