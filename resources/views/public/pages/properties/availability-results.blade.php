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
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="search-breadcrumbs" class="row mb-3">  
        <div class="col-xs-9">
            <span class="">
                @if($city)
                    {{ $city->name }} / 
                @endif
                
                {{ __('Travel dates') }}: {{ $bothDates }} / 
                {{ __('Bedrooms') }}: {{ $bedrooms }} / 
                {{ __('Adults') }}: {{ $adults }} / 
                {{ __('Children') }}: {{ $children }}
            </span>
        </div>  
    </div>

    <div id="availability-results">

        <div class="well well-sm text-right">
            {{ __('Showing') }} {{ $properties->firstItem() }} {{ __('To') }}
            {{ $properties->lastItem() }} {{ __('Of') }} {{ $properties->total() }} {{ __('Results') }}
        </div>

        @foreach ($properties as $property)
            @if($property->propertyRate['total'] <= 0)
                @php continue; @endphp
            @endif

            @php
                $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999999);
            @endphp

            @include('public.pages.partials.modal')

            <div class="result-row">
                <h5>{{ $property->name }}</h5>

                <div class="sub-title">{{ $property->property->type->getLabel() }} /
                    {{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }}
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4 mb-3">
                        <img src="{{ getFeaturedImage($property->property_id) }}" width="100%">
                        <div class="rate-info">{{ priceFormat($property->propertyRate['nightlyAppliedRate']) }} <span>/ {{ __('Night') }}</span></div>
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
                                    <a href="{{ route('public.property-detail', [App::getLocale(), getZone($property->property_id), $property->slug]) }}" 
                                        title="View FULL details" class="full-details">
                                        {{ __('View FULL details') }}
                                    </a>
                                </div>				
                            </div>	
                            
                            @if($property->saving > 0 && $property->availabilityProperty == 'all')
                                <div class="col-xs-6 col-sm-6">   				
                                    <div class="text-right savings-tag">
                                        <i class="glyphicon glyphicon-tags"></i> 
                                        {{ __('Save') }} <span>{{ priceFormat($property->saving) }} USD</span>
                                    </div>				
                                </div>    		
                            @endif
                        </div>

                        @if ($property->availabilityProperty == 'all')
                            <div class="row">		
                                <div class="col-xs-4 col-sm-4 text-center">   
                                    @if($property->propertyRate['nightlyAvgRate'] > $property->propertyRate['nightlyAppliedRate'])    	
                                        <div class="b-rate b-strike">{{ priceFormat($property->propertyRate['nightlyAvgRate']) }} USD</div>		
                                    @endif
                                    <div class="b-savings">{{ priceFormat($property->propertyRate['nightlyAppliedRate']) }} USD</div> 			
                                    <div class="b-caption">{{ __('avg. night') }}</div>   				
                                </div>		
                                
                                <div class="col-xs-8 col-sm-8">			
                                    <div class="total-stay text-right">
                                        {{ __('Total stay') }}: <span>{{ priceFormat($property->propertyRate['total']) }} USD</span>
                                        <br>
                                        {{ $bothDates }} 
                                        ( 
                                            {{ $nightsDate }} 
                                        
                                            @if($nightsDate > 1)
                                                {{ __('nights') }} 
                                            @else
                                                {{ __('night') }}
                                            @endif
                                        )
                                    </div>			
                                    <div class="text-right">
                                        <a href="{{ route('public.reservations', [App::getLocale(), $property->property_id]) }}"
                                            class="btn btn-warning">{{ __('Book it!') }}
                                        </a>
                                    </div>   				
                                </div> 
                            </div>
                        @elseif($property->availabilityProperty == 'some')
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
                        @elseif($property->availabilityProperty == 'none')
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
