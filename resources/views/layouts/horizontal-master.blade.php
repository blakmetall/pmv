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

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- css before theme -->
    @yield('before-css')

    {{-- theme css --}}
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/palmera-vacations.min.css') }}">

    {{-- vendor css --}}
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">

    {{-- app css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- page specific css --}}
    @yield('page-css')

    {{-- favicon --}}
    @include('partials.favicon')

</head>


<body class="text-left">

    <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">
        <div class="loader spinner-bubble spinner-bubble-primary"></div>
    </div>
    <!-- Pre Loader end  -->


    <!-- ============ Horizontal Layout start ============= -->
    <div class="app-admin-wrap layout-horizontal-bar clearfix">

        <!-- header menu -->
        @include('layouts.header-menu')


        <!-- bar menu -->
        @include('layouts.horizontal-bar')


        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap  d-flex flex-column">
            <div class="main-content">

                <!-- HEADING CONTENT -->
                @yield('heading-content')

                <!-- flash messages -->
                @include('partials.flash-messages')

                <!-- MAIN CONTENT -->
                @yield('main-content')

            </div>

            <!-- footer -->
            @include('layouts.footer')
        </div>
        <!-- ============ Body content End ============= -->

    </div>
    <!-- ============ Horizontal Layout End ============= -->


    {{-- common js --}}
    <script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>

    {{-- page specific javascript --}}
    @yield('page-js')

    {{-- theme javascript --}}
    <script src="{{ asset('assets/js/gull-script.js') }}"></script>

    {{-- scripts for horizontal sidebar --}}
    <script src="{{ asset('assets/js/sidebar-horizontal.script.js') }}"></script>

    {{-- scripts for goole map --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-f1EwqXeVmncPaFsvn8LQDKt2G6tsMSU" async defer></script>

    {{-- app js --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- scripts js --}}
    <script src="{{ asset('js/scripts.js') }}"></script>

    <!-- yield js bottom -->
    @yield('bottom-js')
</body>

</html>