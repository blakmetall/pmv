<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! SEO::generate(true) !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    {{-- prev theme public css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/public.css') }}">
    
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/custom.css') }}">

    {{-- app public css --}}
    <link rel="stylesheet" href="{{ asset('css/public_base.css') }}">
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

    <script src="/js/moment.min.js"></script>

    {{-- theme javascript --}}
    <script src="{{ asset('assets/public/js/public.js') }}"></script>

    @if(App::getLocale() == 'es')
        <script src="/assets/public/js/locale.datepicker.js"></script>
    @endif

    <!-- yield js bottom -->
    @yield('bottom-js')
</body>

</html>
