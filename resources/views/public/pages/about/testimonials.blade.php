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
                <div class="panel-pane pane-block pane-views-testimonials-block-1">
                    <div class="pane-content">
                        <div
                            class="view view-testimonials view-id-testimonials view-display-id-block_1 view-testimonials-list">
                            <div class="view-content">
                                <table class="views-view-grid cols-1">
                                    <tbody>
                                        @foreach ($testimonials as $testimonial)
                                            <tr>
                                                <td>
                                                    <div class="views-field views-field-body">
                                                        <div class="field-content">
                                                            <a
                                                                href="{{ route('public.about.testimonial', [$testimonial->testimonial_id]) }}">
                                                                {!! $testimonial->description !!}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="views-field views-field-title">
                                                        <span class="field-content">{{ $testimonial->title }}</span>
                                                    </div>
                                                    @if ($testimonial->location)
                                                        <div class="views-field views-field-field-company-location">
                                                            <div class="field-content">{{ $testimonial->location }}</div>
                                                        </div>
                                                    @endif
                                                    @if ($testimonial->occupation)
                                                        <div class="views-field views-field-field-company-location">
                                                            <div class="field-content">{{ $testimonial->occupation }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- pagination is loeaded here -->
                            <div class="text-center">
                                @include('partials.pagination', ['rows' => $testimonials])
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
