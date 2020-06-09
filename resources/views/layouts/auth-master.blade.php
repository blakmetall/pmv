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
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">

        {{-- theme css --}}
        <link rel="stylesheet" href="{{asset('assets/styles/css/themes/palmera-vacations.min.css')}}">

        {{-- app css --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- page specific css --}}
        @yield('page-css')
    </head>

    <body>
        <div class="auth-layout-wrap">
            <div class="auth-content">

                <div class="auth-about">
                    <img src="{{ asset('assets/images/logo-full.png')}}" alt="">
                </div>


                @yield('main-content')

            </div>
        </div>

        {{-- common js --}}
        <script src="{{mix('assets/js/common-bundle-script.js')}}"></script>

        {{-- page specific javascript --}}
        @yield('page-js')

        {{-- theme javascript --}}
        <script src="{{asset('assets/js/script.js')}}"></script>

        {{-- scripts for horizontal sidebar --}}
        <script src="{{asset('assets/js/sidebar-horizontal.script.js')}}"></script>


        {{-- app js --}}
        <script src="{{asset('js/app.js')}}"></script>

        {{-- scripts js --}}
        <script src="{{asset('js/scripts.js')}}"></script>

        <!-- yield js bottom -->
        @yield('bottom-js')
    </body>

</html>
