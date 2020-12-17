@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('PROPERTY & BUILDING MANAGEMENT');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-2col-stacked clearfix panel-display">
        <div class="panel-col-top panel-panel">
            <div class="inside">
                <div class="panel-pane pane-custom pane-4">
                    <div class="pane-content">
                        <img src="http://palmeravacations.com/sites/default/files/images/pm.jpg" width="100%">
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-5">
                    <div class="pane-content">
                        <p>Trying to manage your property from another city or country can be a difficult and frustrating
                            task. Let our dedicated experts do the work for you. Palmera Vacations offers complete
                            personalized, hands-on service for all of your property management needs.</p>
                        <p>Our team of friendly professionals will administer your property and take care of everything for
                            you. You will have peace of mind knowing your property is in good hands.</p>
                        <p>We specialize in all types of Puerto Vallarta, Nuevo Vallarta, Riviera Nayarit &amp; Mazatlán
                            vacation homes including short or long term rentals and privately owned vacation homes.</p>
                        <p>Palmera Vacations will handle all of your property management requirements:</p>
                        <ul class="list">
                            <li>Bill payments</li>
                            <li>Monthly account statements</li>
                            <li>Weekly property inspections</li>
                            <li>Housekeeping services</li>
                            <li>Landscaping/gardening services</li>
                            <li>Concierge services</li>
                        </ul>
                        <p>Reliable, supportive staff on-call for all your property management needs.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="panel-col-first panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-2">
                        <h4 class="pane-title">
                            Basic Management </h4>
                        <div class="pane-content">
                            <ul class="list">
                                <li>Housekeeping services</li>
                                <li>Pest control (based on season)</li>
                                <li>Daily maintenance (small repairs)</li>
                                <li>Preventive maintenance (large repairs): contracting, coordinating and supervising</li>
                                <li>Preventive measures (seasonal and natural conditions)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-col-last panel-panel">
                <div class="inside">
                    <div class="panel-pane pane-custom pane-3">
                        <h4 class="pane-title">
                            Administrative Management </h4>
                        <div class="pane-content">
                            <ul class="list">
                                <li>Scheduled communication with owner</li>
                                <li>Administrative reports (monthly/annually)</li>
                                <li>Communication with other rental agents/realtors</li>
                                <li>Utility payments/Government bills</li>
                                <li>Calendar administration/management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-col-bottom panel-panel">
            <div class="inside">
                <div class="panel-pane pane-custom pane-1">
                    <h4 class="pane-title">
                        Rental Related Management </h4>
                    <div class="pane-content">
                        <ul class="list">
                            <li>Meet and greet guests</li>
                            <li>Concierge service for guests</li>
                            <li>Key service</li>
                            <li>Housekeeping services</li>
                            <li>Gardening/landscaping</li>
                            <li>Pool maintenance</li>
                            <li>Emergency line (24 hour answering service)</li>
                            <li>Inventory control (before and after renting)</li>
                            <li>Featured Property on the Palmera Vacations website</li>
                            <li>Complex rules &amp; regulations extended to guests</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
