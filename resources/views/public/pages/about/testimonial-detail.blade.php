@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $testimonial->translate()->title;
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-block pane-views-testimonials-block-1">
                    <div class="pane-content">
                        <div
                            class="view view-testimonials view-id-testimonials view-display-id-block_1 view-testimonials-list">
                            <div class="view-content">
                                <table class="views-view-grid cols-1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="views-field views-field-body">
                                                    <div class="field-content" style="font-style: italic">
                                                        {!! $testimonial->translate()->description !!}
                                                    </div>
                                                </div>
                                                @if ($testimonial->translate()->location)
                                                    <div class="views-field views-field-field-company-location">
                                                        <div class="field-content">{{ $testimonial->translate()->location }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($testimonial->translate()->occupation)
                                                    <div class="views-field views-field-field-company-location">
                                                        <div class="field-content">
                                                            {{ $testimonial->translate()->occupation }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
