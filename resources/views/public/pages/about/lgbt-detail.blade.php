@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $lgbt->translate()->title;
    @endphp

    @include('public.pages.partials.main-content-start')

    <article id="node-1" class="node node-business-directory clearfix">
        <div class="field field-name-field-logo field-type-image field-label-hidden">
            <div class="field-items">
                <div class="field-item even">
                    <img src="{{ $lgbt->file_url }}" alt="">
                </div>
            </div>
        </div>
        <div class="field field-name-body field-type-text-with-summary field-label-hidden">
            <div class="field-items">
                <div class="field-item even">{!! $lgbt->translate()->description !!}</div>
            </div>
        </div>
    </article>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
