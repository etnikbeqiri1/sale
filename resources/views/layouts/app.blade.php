<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
        <link href="https://fonts.cdnfonts.com/css/tt-norms-pro" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' data-name='Layer 1' viewBox='0 0 64 64' id='gaming'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='8.837' x2='52.552' y1='2.299' y2='55.156' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23fff'%3E%3C/stop%3E%3Cstop offset='.139' stop-color='%23fff'%3E%3C/stop%3E%3Cstop offset='.397' stop-color='%23fff'%3E%3C/stop%3E%3Cstop offset='.742' stop-color='%23fff'%3E%3C/stop%3E%3Cstop offset='1' stop-color='%23fff'%3E%3C/stop%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath fill='url(%23a)' d='M41 35.98h-2v-2.037h2Zm0 4.106h-2v2.036h2Zm3.09-3.053h-2.034v2h2.036Zm-6.144 0h-2.033v2h2.035Zm-23.3-2.34h-2v2.3h-2.3v2h2.3v2.3h2v-2.3h2.3v-2h-2.3Zm6.889 1h10.646v-2H21.535Zm38.975 8.251H49.3l1.1 7.508a6.821 6.821 0 0 1-12.966 3.8l-2.2-4.868a4.372 4.372 0 0 1-1.811.4 4.417 4.417 0 0 1-4.293-3.417h-4.521a4.417 4.417 0 0 1-4.293 3.417 4.37 4.37 0 0 1-1.837-.412l-2.2 4.882a6.821 6.821 0 0 1-12.966-3.8l1.482-10.07a9.852 9.852 0 0 1 9.359-12.757V6.98a1 1 0 0 1 1-1H60.51a1 1 0 0 1 1 1v35.964a1 1 0 0 1-1 1Zm-43.647 5.138a4.395 4.395 0 0 1-.6-.969 9.773 9.773 0 0 1-9.9-3.691l-1.072 7.321a4.82 4.82 0 0 0 9.163 2.683Zm5.87-2.721a2.417 2.417 0 1 0-2.417 2.417 2.419 2.419 0 0 0 2.417-2.417Zm10.7-4.417a4.412 4.412 0 0 1 4.394 4.188 7.755 7.755 0 0 0 1.677.2 7.857 7.857 0 1 0 0-15.714 7.775 7.775 0 0 0-3.571.865.989.989 0 0 1-.455.11H18.24a.989.989 0 0 1-.455-.11 7.775 7.775 0 0 0-3.571-.865 7.857 7.857 0 1 0 0 15.714 7.749 7.749 0 0 0 1.71-.213 4.4 4.4 0 0 1 8.685-.762h4.529a4.418 4.418 0 0 1 4.293-3.413Zm0 6.834a2.417 2.417 0 1 0-2.417-2.417 2.419 2.419 0 0 0 2.415 2.417Zm14.994%202.965-1.077-7.321a9.618%209.618%200%200%201-9.86%203.679%204.422%204.422%200%200%201-.625%201.006l2.4%205.319a4.82%204.82%200%200%200%209.163-2.683ZM59.51%207.98H16.153v20.846a9.8%209.8%200%200%201%202.322.771h16.766a9.743%209.743%200%200%201%204.261-.975%209.858%209.858%200%200%201%209.42%2012.76l.083.562h10.5Zm-3.543%207.989L51%2011l-1.414%201.414%204.965%204.965Zm-.9%206.5L44.5%2011.907l-1.414%201.414L53.65%2023.883Z'%3E%3C/path%3E%0A%3C/svg%3E">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content') @if( isset($slot) ) {{ $slot }} @endif
            </main>

        </div>

        @stack('modals')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

        @livewireScripts
    </body>
</html>
