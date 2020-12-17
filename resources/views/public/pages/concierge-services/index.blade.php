@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('CONCIERGE SERVICES');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-2col-stacked clearfix panel-display">
        <div class="panel-col-top panel-panel">
            <div class="inside">
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        <img src="http://palmeravacations.com/sites/default/files/images/cs.jpg" width="100%">
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-4">
                    <div class="pane-content">
                        <p>Palmera Vacations' first class concierge services are designed to make your vacation both
                            pleasurable and memorable. We know your time is valuable so let us help you make the most of
                            your vacation. We can arrange just about anything Puerto Vallarta and Mazatlán have to offer.
                            Whether you're simply interested in finding the cheapest happy hour in town or in the mood to
                            take a horseback ride to a secluded oasis... you will be well taken care of by our knowledgeable
                            and friendly staff. Attention to detail is what sets us apart... no request is too big or too
                            small. It's your vacation, so go ahead and ask.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="panel-col-first panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-1">
                        <div class="pane-content">
                            <ul class="list">
                                <li>Airport Pick-up &amp; Drop-off</li>
                                <li>Dining Reservations</li>
                                <li>Limousine Service</li>
                                <li>Personal Chef</li>
                                <li>In-House Massages</li>
                                <li>Event Planning</li>
                                <li>Grocery Shopping</li>
                                <li>Pet Care</li>
                                <li>Floral Delivery</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-col-last panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-2">
                        <div class="pane-content">
                            <ul class="list">
                                <li>Medical Appointments</li>
                                <li>In-house Beauty and Hair Salon Services</li>
                                <li>Boat Charters</li>
                                <li>Prescription Pick-Up</li>
                                <li>Dry Cleaning and Laundry Services</li>
                                <li>Personal Fitness/Yoga Sessions</li>
                                <li>Tours &amp; Activities</li>
                                <li>and more...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
