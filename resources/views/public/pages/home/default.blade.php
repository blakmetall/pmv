@extends('layouts.public-master')

@php
    $slideNum = rand(1,8);
    $slideClass = 'slide-' . $slideNum;

@endphp

@section('main-content')
    <div class="page-home">
        <div class="content-top-container {{ $slideClass }}">
            <section class="content-top container">
                <div class="region region-content-top">

                    @include('public.pages.partials.quick-search')

                    <section id="block-panels-mini-block-home-search" class="block block-panels-mini clearfix">
                        <div class="panel-display panel-1col clearfix" id="mini-panel-block_home_search">
                            <div class="panel-panel panel-col">
                                <div>
                                    <div class="panel-pane pane-custom pane-4">
                                        <div class="pane-content">
                                            <div class="home-info">
                                                <div class="title">{{ __('The destination of your dreams') }}</div>
                                                <br><span class="sub">{{ __('Is just a click away') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-separator"></div>

                                    <div class="panel-pane pane-block pane-avail-search-avail-search-block">
                                        <div class="pane-content">

                                            @include('public.pages.partials.check-availability')

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>

        <div class="main-container container">
            <div class="row">
                <section class="col-sm-12">
                    <a id="main-content"></a>
                    <h1 class="page-header">{{ __('Welcome to Palmera Vacations!') }}</h1>
                    <div class="region region-content">
                        <section id="block-system-main" class="block block-system clearfix">
                            <div class="panel-display panel-1col clearfix">
                                <div class="panel-panel panel-col">
                                    <div>

                                        @include('public.pages.home.partials.welcome')

                                        <div class="clearfix"></div>
                                        <div class="panel-separator"></div>

                                        @include('public.pages.home.partials.featured')

                                        <div class="clearfix"></div>
                                        <div class="panel-separator"></div>

                                        @include('public.pages.home.partials.offer')

                                        <div class="clearfix"></div>
                                        <div class="panel-separator"></div>

                                        @include('public.pages.home.partials.new-listings')

                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </section>

            </div>
        </div>

        <div class="clearfix"></div>
        <div class="panel-separator mb-5"></div>

        @include('public.pages.home.partials.why')

        <div class="panel-separator mb-5"></div>

        @include('public.pages.home.partials.testimonials')

        @include('public.pages.home.partials.members')
    </div>


    @include('public.pages.partials.footer')

@endsection
