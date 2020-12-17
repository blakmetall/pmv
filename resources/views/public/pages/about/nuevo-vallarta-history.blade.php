@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('NUEVO VALLARTA HISTORY');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div class="pv-history">
                            <p>Ten minutes from Puerto Vallarta International Airport and a spectacular view of the Pacific
                                Ocean, is this heavenly destination with beaches, islands and multiple services.</p>

                            <p><img src="http://palmeravacations.com/sites/default/files/images/nuevo-vallarta-1.jpg"
                                    class="pull-left">Located north of Puerto Vallarta, this area has become a major tourist
                                destination at national and international level, surrounded by the lush vegetation of the
                                Sierra Madre in contrast to the bright blue sea. One of its main attractions is the great
                                care they have made environmental level to avoid damaging or altering the environment,
                                creating diverse ecological lodging options. It has 10 kilometers of navigable waterways,
                                numerous beaches and housing developments are created continuously, so it has all the
                                essential services. It also has two prestigious golf courses with 18 holes (designed by Jack
                                Nicklaus and Robert Von Hagge), exclusive hotels, world-class spas, a sports club and a
                                luxury shopping center. On the streets we find shops and restaurants to suit all tastes,
                                from crafts and seafood dishes to luxurious brands and international cuisine.</p>

                            <p>In Nuevo Vallarta highlights the marina, where yachts, sailboats, catamarans and fishing
                                boats swaying to the rhythm of the waves while their owners and service companies come and
                                go along the quays.</p>

                            <p>Because it is in the open sea you can fish, dive, snorkel or just swim, but it is best to
                                rent a boat to see humpback whales, dolphins and stingrays, to reach the Marieta Islands, an
                                ecological reserve with stunning underwater caves and great diversity of birds.</p>

                            <p><img src="http://palmeravacations.com/sites/default/files/images/nuevo-vallarta-2.jpg"
                                    class="pull-right">For those who prefer sunbathing or playing sports like volleyball,
                                you can enjoy its beaches in Bahia de Banderas: Piedra Blanca, Punta Mita, San Francisco and
                                Sayulita, the latter is visited, especially by surfers. In addition, each year the
                                International Banderas Bay Regatta takes place in March.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
