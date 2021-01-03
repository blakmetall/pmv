@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('AVAILABILITY RESULTS');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="availability-results">
        <div class="well well-sm text-right">Showing 1 to 1 of {{ $properties->total() }} results</div>
        @foreach ($properties as $property)
            <div class="result-row">
                <h5>{{ $property->name }}</h5>
                <div class="sub-title">{{ $property->property->type->getLabel() }} /
                    {{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }}
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <img src="{{ getFeaturedImage($property->property_id) }}" width="100%" height="200">
                        <div class="rate-info">${{ getLowerRate($property->property_id) }} <span>/ night</span></div>
                    </div>
                    <div class="col-xs-8">
                        <div class="description">
                            {{ getSubstring($property->description, 200) }}
                        </div>
                        <div class="col-xs-4 opt1"> <i class="fa fa-bed"></i>
                            <div class="text-center">Bedrooms<br> {{ $property->property->bedrooms }}</div>
                        </div>
                        <div class="col-xs-4 opt2"> <i class="fa fa-shower"></i>
                            <div class="text-center">Bathrooms<br> {{ $property->property->baths }}</div>
                        </div>
                        @if ($property->property->pax)
                            <div class="col-xs-4 opt3"> <i class="fa fa-users"></i>
                                <div class="text-center">Max. Occupancy<br> {{ $property->property->pax }}</div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="details-link">
                                    <i class="glyphicon glyphicon-play"></i>
                                    <a href="{{ route('public.property-detail', [getZone($property->property_id), generateSlug($property->name)]) }}"
                                        title="View FULL details" class="full-details">View FULL details</a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="text-right savings-tag"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <div class="b-rate ">${{ getLowerRate($property->property_id) }} USD</div>
                                <div class="b-caption">avg. night</div>
                            </div>
                            <div class="col-xs-8">
                                <div class="total-stay text-right">Total stay: <span>$2,450 USD</span><br>Wednesday
                                    23/December/2020 - Wednesday 30/December/2020 ( 7 nights )</div>
                                <div class="text-right">
                                    <form id="bookit-618-form" action="reservations" method="post"><input type="hidden"
                                            name="pid" value="618"><input type="submit" name="submit" value="Book it!"
                                            title="Book this property" class="btn btn-warning"></form>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning text-center"> One or more nights are not available for dates
                            <strong>Wednesday 23/December/2020 - Wednesday 30/December/2020</strong>,<br> please check the
                            <a href="http://palmeravacations.com/_availability_calendar.php?id=898"
                                title="Availability Calendar" target="_blank">Availability Calendar</a> and edit your
                            search.
                        </div>
                        <div class="alert alert-danger text-center"> Not available for dates: <strong>Saturday
                                12/December/2020
                                - Saturday 19/December/2020</strong>,<br> please check the <a
                                href="http://palmeravacations.com/_availability_calendar.php?id=749"
                                title="Availability Calendar" target="_blank">Availability Calendar</a> and edit your
                            search.
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- pagination is loeaded here -->
        <div class="text-center">
            @include('partials.pagination', ['rows' => $properties])
        </div>
    </div>

    @include('public.pages.properties.partials.new-listings')

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
