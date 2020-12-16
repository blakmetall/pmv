@extends('layouts.public-master')

@section('main-content')

    @php
    $searchUrl = '/vacation-services';
    @endphp

    <div class="content-top-container bg-none">
        <section class="content-top container">
            <div class="region region-content-top">
                @include('public.pages.partials.quick-search')
                <section id="block-search-breadcrumbs-search-breadcrumbs-block"
                    class="block block-search-breadcrumbs clearfix">

                    <h2 class="block-title">Your Search</h2>

                    <div id="search-breadcrumbs" class="row">
                        <div class="col-xs-9"><span class="search-params-breadcrumbs">Travel dates: Saturday
                                12/December/2020 - Saturday 19/December/2020 / </span></div>
                        <div class="col-xs-3 text-right"><a href="# " id="toggle-search" title="Show Search Form"
                                class="btn btn-warning btn-xs show-search">Show Search Form</a></div>
                    </div>
                </section>
                <section id="block-avail-search-avail-search-block" class="block block-avail-search clearfix">

                    @include('public.pages.partials.check-availability')

                </section>
            </div>
        </section>
    </div>

    <div class="main-container container">
        <header role="banner" id="page-header">
        </header> <!-- /#page-header -->
        <div class="row">
            <section class="col-sm-9">
                <a id="main-content"></a>
                <h1 class="page-header">Vacation Services</h1>
                <div class="region region-content">
                    <section id="block-system-main" class="block block-system clearfix">

                        <div class="panel-display panel-1col clearfix">
                            <div class="panel-panel panel-col">
                                <div>
                                    <div class="panel-pane pane-custom pane-1">

                                        <div class="pane-content">
                                            <p>Let us make your perfect Getaway in Puerto Vallarta, Nuevo Vallarta, Riviera
                                                Nayarit and Mazatlán, México!</p>
                                            <p>We focus on providing accommodations tailored to meet your specific needs,
                                                our vacation rental professionals are committed to setting the standard and
                                                exceeding the expectations of today's traveler.</p>
                                            <p>If you're looking to rent an apartment, condominium, villa or private estate;
                                                whether it's oceanfront or right in the middle of the bustling nightlife,
                                                Palmera Vacations will find the right accommodations to fit your needs.</p>
                                            <p>Our innovative website leads you through easy, no-nonsense steps from start
                                                to finish. Browse through our wide-range of vacation properties or even make
                                                a reservation, book &amp; pay online! Don't see exactly what you're looking
                                                for? Not to worry! We will find it through our extensive network of local
                                                real estate partners, or if you find yourself in the neighborhood, come on
                                                by our office!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

            <aside class="col-sm-3" role="complementary">
                <div class="region region-sidebar-second">
                    <section id="block-block-2" class="block block-block clearfix">
                        <div class="text-right"><a href="/availability-results" title="Return to the Search Results"><i
                                    class="fas fa-chevron-circle-left"></i> Return to the Search Results</a></div>
                    </section>
                    <section id="block-menu-menu-travel-resources" class="block block-menu clearfix">
                        <h2 class="block-title">Travel Resources</h2>
                        <ul class="menu nav">
                            <li class="first leaf"><a href="/puerto-vallarta-history" title="Puerto Vallarta">Puerto
                                    Vallarta</a></li>
                            <li class="leaf"><a href="/nuevo-vallarta-history" title="Nuevo Vallarta">Nuevo Vallarta</a>
                            </li>
                            <li class="leaf"><a href="/mazatlan-history" title="Mazatlán">Mazatlán</a></li>
                            <li class="leaf"><a href="/concierge-services" title="Concierge Services">Concierge Service</a>
                            </li>
                            <li class="leaf"><a href="/helpful-information" title="Helpful Information">Helpful
                                    Information</a></li>
                            <li class="leaf"><a href="/accidental-rental-damage-insurance"
                                    title="Damage Insurance (ARDI)">Damage Insurance (ARDI)</a></li>
                            <li class="last leaf"><a href="/rental-agreement" title="Rental Agreement">Rental Agreement</a>
                            </li>
                        </ul>
                    </section>
                </div>
            </aside>
        </div>
    </div>

    @include('public.pages.partials.footer')

@endsection
