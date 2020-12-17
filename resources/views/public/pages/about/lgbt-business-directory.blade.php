@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('LGBT BUSINESS DIRECTORY');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div class="node-business-directory text-center">
                            <img src="http://palmeravacations.com/sites/default/files/images/gay-pv.png">
                        </div>
                        <p>Discover and Play the Gay Scene in Puerto Vallarta, Mexico's #1 Gay Destination with GAYPV
                            Magazine. A complete directory to the gay and friendly businesses, gay travel deals, event
                            calendars, and around town photos. Down the mobile app when on the go.</p>

                        <p><a href="http://www.gaypv.mx/" title="Click here for more information" target="_blank"
                                rel="nofollow">Click here for more information.</a></p>

                        <p><small>Disclaimer:Palmera Vacations assumes no responsibility for the services rendered by GayPV
                                Magazine.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
