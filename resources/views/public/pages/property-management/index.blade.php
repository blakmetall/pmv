@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $page->translate()->title;
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-2col-stacked clearfix panel-display">
        <div class="panel-col-top panel-panel">
            <div class="inside">
                <div class="panel-pane pane-custom pane-4">
                    <div class="pane-content">
                        <img src="/assets/public/images/pm.jpg" alt="" class="img-100 mb-5"/>

                        {!! $page->translate()->description !!}
                    </div>
                </div>
                <br>
                <div class="panel-pane pane-custom pane-5">
                    <div class="pane-content">
                        {!! $page->translate()->mid_description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="panel-col-first panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-2">
                        {!! $page->translate()->left_col !!}
                    </div>
                </div>
            </div>
            <div class="panel-col-last panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-3">
                        {!! $page->translate()->right_col !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
