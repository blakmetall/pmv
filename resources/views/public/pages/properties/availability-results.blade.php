@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('AVAILABILITY RESULTS');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="availability-results">
        <div class="well well-sm text-right">Showing 1 to 1 of 1 results</div>
        <div class="result-row">
            <h5>Puesta Del Sol 411</h5>
            <div class="sub-title">Condo / Mazatlán / Mazatlán</div>
            <div class="row">
                <div class="col-xs-4">
                    <img src="http://palmeravacations.com/images/property-images/749/thumbs/img-JgyTYhqj.jpg" width="100%"
                        height="200">
                    <div class="rate-info">$140 <span>/ night</span></div>
                </div>
                <div class="col-xs-8">
                    <div class="description">Are you ready for the most relaxing vacation you have ever experienced? Palmera
                        Vacations introducing, Puesta Del Sol 411 condo will meet all your expectations!
                        ...</div>
                    <div class="col-xs-4 opt1"> <i class="fa fa-bed"></i>
                        <div class="text-center">Bedrooms<br> 3</div>
                    </div>
                    <div class="col-xs-4 opt2"> <i class="fa fa-shower"></i>
                        <div class="text-center">Bathrooms<br> 2</div>
                    </div>
                    <div class="col-xs-4 opt3"> <i class="fa fa-users"></i>
                        <div class="text-center">Max. Occupancy<br> 8</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="details-link"><i class="glyphicon glyphicon-play"></i> <a
                                    href="/mazatlan/puesta-del-sol-411" title="View FULL details" class="full-details">View
                                    FULL details</a></div>
                        </div>
                        <div class="col-xs-6">
                            <div class="text-right savings-tag"></div>
                        </div>
                    </div>
                    <div class="alert alert-danger text-center"> Not available for dates: <strong>Saturday 12/December/2020
                            - Saturday 19/December/2020</strong>,<br> please check the <a
                            href="http://palmeravacations.com/_availability_calendar.php?id=749"
                            title="Availability Calendar" target="_blank">Availability Calendar</a> and edit your search.
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.properties.partials.new-listings')

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
