<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- app name -->
    <title>{{ config('app.name', 'Palmera Vacations Admin') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">

    {{-- public css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/public.css') }}">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    {{-- page specific css --}}
    @yield('page-css')

    {{-- favicon --}}
    @include('partials.favicon')

</head>

<body class="html front not-logged-in no-sidebars i18n-en">
    @include('public.pages.partials.header')


    @yield('main-content')

    {{-- page specific javascript --}}
    @yield('page-js')

    {{-- theme javascript --}}
    <script src="{{ asset('assets/public/js/public.js') }}"></script>

    <!-- yield js bottom -->
    @yield('bottom-js')
</body>

</html>
