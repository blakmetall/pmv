@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('AVAILABILITY RESULTS');
    $nightsDate = \RatesHelper::getTotalBookingDays($_GET['arrival'], $_GET['departure']);
    $datesProperty = getSearchDate(false, $_GET['arrival'], $_GET['departure']);
    $bothDates = $datesProperty['currentDate'] . ' - ' . $datesProperty['nextDate'];
    $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    @endphp

    @include('public.pages.partials.main-content-start')


    <div id="availability-results">
        <div class="well well-sm text-right">{{ __('Showing') }} {{ $properties->firstItem() }} {{ __('To') }}
            {{ $properties->lastItem() }} {{ __('Of') }} {{ $properties->total() }} {{ __('Results') }}
        </div>
        @foreach ($properties as $property)
            @include('public.pages.partials.modal')
            @php
                $total = \RatesHelper::getNightsSubtotalCost($property->property, $_GET['arrival'], $_GET['departure']);
                $availabilityProperty = getAvailabilityProperty($property->property_id, $_GET['arrival'], $_GET['departure']);
                $nightlyRate = \RatesHelper::getNightlyRate($property->property, null, $_GET['arrival'], $_GET['departure']);
            @endphp
            <div class="result-row">
                <h5>{{ $property->name }}</h5>
                <div class="sub-title">{{ $property->property->type->getLabel() }} /
                    {{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }}
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <img src="{{ getFeaturedImage($property->property_id) }}" width="100%" height="200">
                        <div class="rate-info">${{ $nightlyRate }} <span>/ {{ __('Night') }}</span></div>
                    </div>
                    <div class="col-xs-8">
                        <div class="description">
                            {{ getSubstring($property->description, 200) }}
                        </div>
                        <div class="col-xs-4 opt1"> <i class="fa fa-bed"></i>
                            <div class="text-center">{{ __('Bedrooms') }}<br> {{ $property->property->bedrooms }}
                            </div>
                        </div>
                        <div class="col-xs-4 opt2"> <i class="fa fa-shower"></i>
                            <div class="text-center">{{ __('Bathrooms') }}<br> {{ (int) $property->property->baths }}
                            </div>
                        </div>
                        @if ($property->property->pax)
                            <div class="col-xs-4 opt3"> <i class="fa fa-users"></i>
                                <div class="text-center">{{ __('Max. Occupancy') }}<br> {{ $property->property->pax }}
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="details-link">
                                    <i class="glyphicon glyphicon-play"></i>
                                    <a href="{{ route('public.property-detail', [getZone($property->property_id), generateSlug($property->name)]) }}"
                                        title="{{ __('View FULL details') }}"
                                        class="full-details">{{ __('View FULL details') }}</a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="text-right savings-tag"></div>
                            </div>
                        </div>
                        @if ($availabilityProperty == 'all')
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <div class="b-rate ">
                                        ${{ $nightlyRate }}
                                        USD</div>
                                    <div class="b-caption">{{ __('Avg. night') }}</div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="total-stay text-right">{{ __('Total Stay') }}:
                                        <span>${{ number_format($total) }}
                                            USD</span><br>{{ $bothDates }}
                                        (
                                        {{ $nightsDate }} {{ __('Nights') }} )
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('public.reservations', [$property->property_id]) }}"
                                            class="btn btn-warning">{{ __('Book it!') }}</a>
                                    </div>
                                </div>
                            </div>
                        @elseif($availabilityProperty == 'some')
                            <div class="alert alert-warning text-center">
                                {{ __('One or more nights are not available for dates') }}
                                <strong>{{ $bothDates }}</strong>,<br>
                                {{ __('Please check the') }}
                                <a href="#" data-toggle="modal" data-source="{{ $property->property_id }}" data-year=""
                                    data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}">
                                    {{ __('Availability Calendar') }}
                                </a> {{ __('And edit your search.') }}
                            </div>
                        @elseif($availabilityProperty == 'none')
                            <div class="alert alert-danger text-center"> {{ __('Not available for dates:') }}
                                <strong>{{ $bothDates }}</strong>,<br>
                                {{ __('Please check the') }} <a href="#" data-toggle="modal"
                                    data-source="{{ $property->property_id }}" data-year=""
                                    data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}"
                                    class="btn-calendar">
                                    {{ __('Availability Calendar') }}
                                </a> {{ __('And edit your search.') }}
                            </div>
                        @endif
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