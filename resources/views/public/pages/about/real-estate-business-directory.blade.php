@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('REAL ESTATE BUSINESS DIRECTORY');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-block pane-views-business-directory-block">
                    <div class="pane-content">
                        <div
                            class="view view-business-directory view-id-business_directory view-display-id-block view-dom-id-d5cf179f4139a4c572a1dd4d3286810e">
                            <div class="view-content">
                                <table class="views-view-grid cols-2">
                                    <tbody>
                                        <tr>
                                            <td class="col-xs-6">
                                                <div class="views-field views-field-field-logo">
                                                    <div class="field-content"><img
                                                            src="http://palmeravacations.com/sites/default/files/business-directory/the-mod-squad.png"
                                                            width="333" height="127" alt=""></div>
                                                </div>
                                                <div class="views-field views-field-title-1"> <strong
                                                        class="field-content">Colwell Banker - The Mod Squad</strong> </div>
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">Contact us today for an appointment or just
                                                        to learn what is going on within the Puerto Vallarta real estate
                                                        market.</div>
                                                </div>
                                                <div> <span><a
                                                            href="/real-estate-business-directory/coldwell-banker-the-mod-squad">READ
                                                            MORE &gt;&gt;</a></span> </div>
                                            </td>
                                            <td class="col-xs-6">
                                                <div class="views-field views-field-field-logo">
                                                    <div class="field-content"><img
                                                            src="http://palmeravacations.com/sites/default/files/business-directory/tropicasa.png"
                                                            width="237" height="127" alt=""></div>
                                                </div>
                                                <div class="views-field views-field-title-1"> <strong
                                                        class="field-content">Tropicasa Realty</strong> </div>
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">Based in Puerto Vallarta, Tropicasa Realty is
                                                        a sustainable full service Real Estate agency with an extensive
                                                        portfolio of properties throughout Banderas Bay.</div>
                                                </div>
                                                <div> <span><a href="/real-estate-business-directory/tropicasa-realty">READ
                                                            MORE &gt;&gt;</a></span> </div>
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
