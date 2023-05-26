<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <!--Font Awesome-->
        <link rek="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

        <!--Font Awesome Kit #bc17b35159-->
        <script src="https://kit.fontawesome.com/bc17b35159.js" crossorigin="anonymous"></script>

        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!--Noto Sans JP-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!--Fabicon-->
        <link rel="shortcut icon" href="{{ asset('/iMAZE-logo.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-black antialiased">
        <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-yellow-400 wrapper">
            <div>
                <a href="/">
                    <div class="flex justify-center items-center">
                        <x-application-logo width="30" class="fill-current h-auto" />
                        <x-application-title-logo width="50" class="fill-current h-auto" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            <div>
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>
