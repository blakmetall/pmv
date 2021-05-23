@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
        $title = __('AVAILABILITY RESULTS');
        $nightsDate = \RatesHelper::getTotalBookingDays($arrival, $departure);
        $datesProperty = getSearchDate(false, $arrival, $departure);
        $bothDates = $datesProperty['currentDate'] . ' - ' . $datesProperty['nextDate'];
        $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="availability-results">
        <div class="well well-sm text-right">
            {{ __('Showing') }} {{ $properties->firstItem() }} {{ __('To') }}
            {{ $properties->lastItem() }} {{ __('Of') }} {{ $properties->total() }} {{ __('Results') }}
        </div>

        @foreach ($properties as $property)
            @include('public.pages.partials.modal')

            @php
                $total = \RatesHelper::getNightsSubtotalCost($property->property, $arrival, $departure);
                $availabilityProperty = getAvailabilityProperty($property->property_id, $arrival, $departure);
                $nightlyRate = \RatesHelper::getNightlyRate($property->property, null, $arrival, $departure);
            @endphp

            <div class="result-row">
                <h5>{{ $property->name }}</h5>

                <div class="sub-title">{{ $property->property->type->getLabel() }} /
                    {{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }}
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-5 mb-3">
                        <img src="{{ getFeaturedImage($property->property_id) }}" width="100%">
                        <div class="rate-info">${{ getLowerRate($property->property_id) }} <span>/ {{ __('Night') }}</span></div>
                    </div>

                    <div class="col-xs-12 col-sm-7">
                        <div class="description">
                            {{ getSubstring($property->description, 200) }}
                        </div>

                        <div class="col-xs-4 opt1"> <i class="fa fa-bed"></i>
                            <div class="text-center">{{ __('Bedrooms') }}<br> {{ $property->property->bedrooms }}
                            </div>
                        </div>

                        <div class="col-xs-4 opt2"> <i class="fa fa-shower"></i>
                            <div class="text-center">{{ __('Bathrooms') }}<br> {{ $property->property->baths }}
                            </div>
                        </div>

                        @if ($property->property->pax)
                            <div class="col-xs-4 opt3"> <i class="fa fa-users"></i>
                                <div class="text-center">{{ __('Max. Occupancy') }}<br> {{ $property->property->pax }}
                                </div>
                            </div>
                        @elseif ($property->property->sleeps)
                            <div class="col-xs-4 opt3"> <i class="fa fa-users"></i>
                                <div class="text-center">{{ __('Max. Occupancy') }}<br> {{ $property->property->sleeps }}
                                </div>
                            </div>
                        @endif

                        <div class="row" style="display: block">
                            <div class="col-xs-6">
                                &nbsp;
                            </div>

                            <div class="col-xs-6">
                                <div class="text-right savings-tag"></div>
                            </div>
                        </div>

                        @if ($availabilityProperty == 'all')
                        <div class="row" style="display: block">
                                <div class="col-md-5">
                                    <div class="b-rate">${{ getLowerRate($property->property_id) }} USD</div>
                                    <div class="b-caption">{{ __('Avg. night') }}</div>
                                </div>

                                <div class="col-md-7">
                                    <div class="text-right mb-3">
                                        <a href="{{ route('public.property-detail', [getZone($property->property_id), generateSlug($property->name)]) }}"
                                            class="btn btn-warning">{{  __('View FULL details')  }}</a>
                                    </div>

                                    <div class="text-right mb-3">
                                        <a href="{{ route('public.property-detail', [getZone($property->property_id), generateSlug($property->name)]) }}#property-rates-info" class="btn btn-primary">
                                            {{  __('Booking price dates')  }}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @elseif($availabilityProperty == 'some')
                            <div class="alert alert-warning text-center">
                                {{ __('One or more nights are not available for dates') }}
                                <strong>{{ $bothDates }}</strong>, <br>
                                
                                {{ __('Please check the') }}

                                <a href="#" data-toggle="modal" data-source="{{ $property->property_id }}" data-year=""
                                    data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}">
                                    {{ __('Availability Calendar') }}
                                </a>
                                
                                {{ __('And edit your search.') }}
                            </div>
                        @elseif($availabilityProperty == 'none')
                            <div class="alert alert-danger text-center"> 
                                {{ __('Not available for dates:') }}

                                <strong>{{ $bothDates }}</strong>,<br>

                                {{ __('Please check the') }}
                                
                                <a href="#" data-toggle="modal"
                                    data-source="{{ $property->property_id }}" data-year=""
                                    data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}"
                                    class="btn-calendar">
                                    {{ __('Availability Calendar') }}
                                </a> 
                                
                                {{ __('And edit your search.') }}
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
