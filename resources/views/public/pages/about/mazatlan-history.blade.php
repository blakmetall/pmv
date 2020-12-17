@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('MAZATLÁN HISTORY');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div class="pv-history">
                            <p><img src="http://palmeravacations.com/sites/default/files/images/mazatlan-1.jpg"
                                    class="pull-right">Mazatlán, a Nahuatl word meaning "place of the deer," is within 10
                                miles of the Pacific coast. Mazatlán is also right below the Tropic of Cancer, which puts it
                                at the same latitude as Honolulu.</p>

                            <p>Because of it's location, Mazatlán has has very mild weather. This weather includes a mild
                                winter, and very little rain from the end of October to June. Throughout the year,
                                temperatures generally range from 68 to 75 degrees Fahrenheit.</p>

                            <p>Mazatlán is also known as the "Pearl of the Pacific", and is Mexico's largest commercial
                                port. In fact, Mazatlán is one the largest West Coast seaports, behind only the Los Angeles
                                port, and the Panama Canal. Because of the port's size, it is a stop for many cruises,
                                including many that travel around the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
