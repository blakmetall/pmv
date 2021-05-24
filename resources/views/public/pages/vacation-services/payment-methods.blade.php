@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $page->translate()->title;
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div id="prop" class="row text-center">
                            @foreach ($paymentMethods as $pindex => $paymentMethod)
                                @php
                                switch($pindex){
                                case 0:
                                $color = 'background-color: #fcc135';
                                break;
                                case 1:
                                $color = 'background-color: #33c7f8';
                                break;
                                case 2:
                                $color = 'background-color: #73e1d0';
                                break;
                                default:
                                $color = 'background-color: #fcc135';
                                break;
                                }
                                @endphp

                                <div class="col-xs-12 col-sm-6 col-md-4 mb-5">
                                    <div class="prop mb-5 pb-5">
                                        <div class="prop-container">
                                            <div class="fa" style="{{ $color }}">
                                                <i class="{{ $paymentMethod->paymentMethod->icon }}"></i>
                                            </div>
                                            <div class="title">{{ $paymentMethod->title }}</div>
                                            <p>{!! $paymentMethod->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-pane pane-custom pane-2">
                    <div class="pane-content">
                        {!! $page->translate()->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
