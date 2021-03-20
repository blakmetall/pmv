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
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        {!! $page->translate()->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="panel-col-first panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-1">
                        {!! $page->translate()->left_col !!}
                    </div>
                </div>
            </div>
            <div class="panel-col-last panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-2">
                        {!! $page->translate()->right_col !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
