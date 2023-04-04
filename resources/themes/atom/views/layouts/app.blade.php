<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('hotel_name') }} - @stack('title')</title>

    <link rel="icon" type="image/gif" sizes="18x17" href="{{ asset('assets/images/home_icon.gif') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('assets/css/flowbite.min.css') }}" />
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/tippy-bundle.umd.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/scale.min.css') }}"/>

    @vite(['resources/themes/atom/css/app.css', 'resources/themes/atom/js/app.js'])
    @stack('scripts')
</head>

<body class="flex min-h-screen flex-col site-bg dark:bg-gray-800">
    <x-messages.flash-messages />

    <div id="app" class="bg-gray-100 dark:bg-gray-900">
        {{-- Top header --}}
        @auth
            <x-top-header />
        @endauth

        {{-- Site Header --}}
        <x-site-header />

        {{-- Navigation --}}
        <nav class="relative bg-white shadow dark:bg-gray-900">
            <div class="max-w-7xl min-h-[60px] px-4 md:flex md:items-center md:justify-between md:mx-auto">
                <x-navigation.navigation-menu />

                <x-navigation.theme-mode-switcher />

                <x-navigation.language-selector>
                    <img src="/assets/images/icons/flags/{{ session()->has('locale') ? session()->get('locale') : config('habbo.site.default_language') }}.png"
                        alt="">
                </x-navigation.language-selector>

                <x-navigation.mobile-menu />
            </div>
        </nav>

        {{-- Content --}}
        <main class="overflow-hidden site-bg">
            <div class="mx-auto mt-10 grid max-w-7xl grid-cols-12 gap-x-3 gap-y-8 p-6 md:mt-0">
                {{ $slot }}
            </div>
        </main>
    </div>

    <x-footer />

    @if (setting('cms_color_mode') === 'dark')
        <script>
            if (localStorage.getItem("theme") === null) {
                document.documentElement.classList.add("dark");
                localStorage.setItem("theme", 'dark');
            }
        </script>
    @endif

    <script defer src="{{ asset('assets/js/alpine-ui.js') }}"></script>
    <script defer src="{{ asset('assets/js/alpine-focus.js') }}"></script>

    @stack('javascript')
    </body>
</html>
