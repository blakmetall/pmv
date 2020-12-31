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
                <div class="panel-pane pane-block pane-views-business-directory-block">
                    <div class="pane-content">
                        <div class="view view-business-directory view-id-business_directory view-display-id-block">
                            <div class="view-content">
                                <table class="views-view-grid cols-2">
                                    <tbody>
                                        <tr>
                                            @foreach ($lgbts as $lgbt)
                                                <td class="col-xs-6">
                                                    <div class="views-field views-field-field-logo">
                                                        <div class="field-content">
                                                            <img src={{ $lgbt->lgbt->file_url }} alt="">
                                                        </div>
                                                    </div>
                                                    <div class="views-field views-field-title-1"> <strong
                                                            class="field-content">{{ $lgbt->title }}</strong>
                                                    </div>
                                                    <div class="views-field views-field-body">
                                                        <div class="field-content">{!! getSubString($lgbt->description, 150)
                                                            !!}</div>
                                                    </div>
                                                    <div>
                                                        <span>
                                                            <a
                                                                href="{{ route('public.about.lgbt-business-directory-detail', $lgbt->lgbt_id) }}">{{ __('READ MORE') }}
                                                                &gt;&gt;</a>
                                                        </span>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- pagination is loeaded here -->
                            <div class="text-center">
                                @include('partials.pagination', ['rows' => $lgbts])
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
