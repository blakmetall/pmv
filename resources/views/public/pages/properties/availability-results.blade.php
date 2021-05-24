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
                $propertyRate = \RatesHelper::getPropertyRate($property->property, $property->property->rates, $arrival, $departure);

                // calculate saving
                $saving = 0;
                if($propertyRate['nightlyCurrentRate'] > $propertyRate['nightlyAppliedRate']) {
                    $savingDailyAmount = $propertyRate['nightlyCurrentRate'] - $propertyRate['nightlyAppliedRate'];
                    $saving = $propertyRate['totalDays'] * $savingDailyAmount;
                }
            @endphp

            <div class="result-row">
                <h5>{{ $property->name }}</h5>

                <div class="sub-title">{{ $property->property->type->getLabel() }} /
                    {{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }}
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4 mb-3">
                        <img src="{{ getFeaturedImage($property->property_id) }}" width="100%">
                        <div class="rate-info">{{ priceFormat($propertyRate['nightlyAppliedRate']) }} <span>/ {{ __('Night') }}</span></div>
                    </div>

                    <div class="col-xs-12 col-sm-8 pl-5">
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

                        <div class="clearfix"></div> 
                        <div class="row">				
                            <div class="col-xs-6 col-sm-6">   				
                                <div class="details-link">
                                    <i class="glyphicon glyphicon-play"></i> 
                                    <a href="{{ route('public.property-detail', [getZone($property->property_id), generateSlug($property->name)]) }}" 
                                        title="View FULL details" class="full-details">
                                        {{ __('View FULL details') }}
                                    </a>
                                </div>				
                            </div>	
                            
                            @if($saving > 0)
                                <div class="col-xs-6 col-sm-6">   				
                                    <div class="text-right savings-tag">
                                        <i class="glyphicon glyphicon-tags"></i> 
                                        {{ __('Save') }} <span>{{ priceFormat($saving) }} USD</span>
                                    </div>				
                                </div>    		
                            @endif
                        </div>

                        @if ($availabilityProperty == 'all')
                            <div class="row">		
                                <div class="col-xs-4 col-sm-4 text-center">   
                                    @if($propertyRate['nightlyCurrentRate'] > $propertyRate['nightlyAppliedRate'])    	
                                        <div class="b-rate b-strike">{{ priceFormat($propertyRate['nightlyCurrentRate']) }} USD</div>		
                                    @endif
                                    <div class="b-savings">{{ priceFormat($propertyRate['nightlyAppliedRate']) }} USD</div> 			
                                    <div class="b-caption">{{ __('avg. night') }}</div>   				
                                </div>		
                                
                                <div class="col-xs-8 col-sm-8">			
                                    <div class="total-stay text-right">
                                        {{ __('Total stay') }}: <span>{{ priceFormat($propertyRate['total']) }} USD</span>
                                        <br>{{ $bothDates }} ( {{ $nightsDate }} {{ __('nights') }} )
                                    </div>			
                                    <div class="text-right">
                                        <form id="bookit-971-form" action="reservations" method="post">
                                            <input type="hidden" name="pid" value="971">
                                            <input type="submit" name="submit" value="Book it!" title="Book this property" class="btn btn-warning">
                                        </form>
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
