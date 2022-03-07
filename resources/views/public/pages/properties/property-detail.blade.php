@extends('layouts.public-master')

@section('page-css')
    {{-- property details css --}}
    <link rel="stylesheet" href="{{ asset('assets/public/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/property-details.css') }}">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $property->name;
    if (isset($_GET['arrival_alt_sing']) && isset($_GET['departure_alt_sing'])) {
        $arrival = $_GET['arrival_alt_sing'];
        $arrivalTxt = $_GET['arrival_sing'];
        $departure = $_GET['departure_alt_sing'];
        $departureTxt = $_GET['departure_sing'];
        $adults = $_GET['adults_sing'];
        $children = $_GET['children_sing'];
        $isInnerSearch = true;
        $searchAvailability = [
            'arrival' => $arrival,
            'arrivalTxt' => $arrivalTxt,
            'departure' => $departure,
            'departureTxt' => $departureTxt,
            'adults' => $adults,
            'children' => $children,
        ];
    } else {
        $arrival = $datesProperty[0];
        $arrivalTxt = $datesProperty[1];
        $departure = $datesProperty[2];
        $departureTxt = $datesProperty[3];
        $searchAvailability = [];
        $isInnerSearch = false;
    }
    $availabilityProperty = getAvailabilityProperty($property->property_id, $arrival, $departure);
    $nightsDate = \RatesHelper::getTotalBookingDays($arrival, $departure);
    $bothDates = $arrivalTxt . ' - ' . $departureTxt;
    $searchAvailability = json_encode($searchAvailability);
    $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    $latitude = $property->property->gmaps_lat;
    $longitude = $property->property->gmaps_lon;
    
    $propertyRate = \RatesHelper::getPropertyRate($property->property, $property->property->rates, $arrival, $departure);

    // calculate saving
    $saving = 0;
    if($propertyRate['nightlyAvgRate'] > $propertyRate['nightlyAppliedRate']) {
        $savingDailyAmount = $propertyRate['nightlyAvgRate'] - $propertyRate['nightlyAppliedRate'];
        $saving = $propertyRate['totalDays'] * $savingDailyAmount;
    }

    $rates = $property->property->rates->sortBy('end_date');
    $currentDate = \Carbon\Carbon::now();
    @endphp

    @include('public.pages.partials.main-content-start')

    @include('public.pages.partials.modal')

    <div id="property-details">
        @if ($property->property->images()->exists())
            <div id="property-gallery-info">
                <div class="cssload-thecube">
                    <div class="cssload-cube cssload-c1"></div>
                    <div class="cssload-cube cssload-c2"></div>
                    <div class="cssload-cube cssload-c4"></div>
                    <div class="cssload-cube cssload-c3"></div>
                </div>
                <div id="slider" class="flexslider flexslider-loading">
                    <ul class="slides"
                        style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                        <li class="flex-active-slide">
                            <img src="{{ getUrlPath($images[0]->file_url, 'large-ls') }}" draggable="false">
                        </li>
                        @foreach ($images as $index => $image)
                            @if ($index == 0)
                                @php
                                    continue;
                                @endphp
                            @endif
                            <li>
                                <img src="{{ getUrlPath($image->file_url, 'large-ls') }}" draggable="false">
                            </li>
                        @endforeach
                    </ul>
                    <ul class="flex-direction-nav">
                        <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1"></a></li>
                        <li class="flex-nav-next"><a class="flex-next" href="#"></a></li>
                    </ul>
                </div>
                <div id="carousel" class="flexslider">
                    <ul class="slides"
                        style="width: 1600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                        <li class="flex-active-slide">
                            <img src="{{ getUrlPath($images[0]->file_url, 'small-ls') }}" draggable="false">
                        </li>
                        @foreach ($images as $index => $image)
                            @if ($index == 0)
                                @php
                                    continue;
                                @endphp
                            @endif

                            <li>
                                <img src="{{ getUrlPath($image->file_url, 'small-ls') }}" draggable="false">
                            </li>
                        @endforeach
                    </ul>
                    <ul class="flex-direction-nav">
                        <li class="flex-nav-prev">
                            <a class="flex-prev flex-disabled" href="#" tabindex="-1"></a>
                        </li>
                        <li class="flex-nav-next"><a class="flex-next" href="#"></a></li>
                    </ul>
                </div>
            </div>
        @endif
        @if ($property->property->url_video)
            <iframe width="100%" height="450" src="https://www.youtube.com/embed/{{ $property->property->url_video }}?controls=0" frameborder="0" rel="1" title="YouTube video player" modestbranding="0" allowfullscreen style="margin-top: 20px"></iframe>
        @endif
        @if ($availabilityProperty == 'all')
            <div id="property-rate-info">
                <div class="alert alert-success text-center">
                    {{ __('Available for dates') }} <strong>{{ $bothDates }} ( {{ $nightsDate }}
                        {{ __('Nights') }}
                        )</strong>
                </div>
                <div class="row" id="availability-results">
                    <div class="col-xs-4 col-sm-4 text-center">
                        @if($propertyRate['nightlyAvgRate'] > $propertyRate['nightlyAppliedRate'])    	
                            <div class="b-rate b-strike">{{ priceFormat($propertyRate['nightlyAvgRate']) }} USD</div>		
                        @endif
                        <div class="b-rate ">{{ priceFormat($propertyRate['nightlyAppliedRate']) }} USD</div>
                        <div class="b-caption">{{ __('Avg. night') }}</div>
                    </div>
                    <div class="col-xs-5 col-sm-5">
                        @if($saving > 0)
                            <div class="text-right savings-tag top-0">
                                <i class="glyphicon glyphicon-tags"></i> 
                                {{ __('Save') }} <span>{{ priceFormat($saving) }} USD</span>
                            </div>					
                        @endif

                        <div class="total-stay text-right">
                            {{ __('Total Stay') }}: 
                            <span>
                                {{ priceFormat($propertyRate['total']) }}USD
                            </span>
                            <br>{{ $bothDates }} ({{ $nightsDate }} {{ __('Nights') }})
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3">
                        <div class="text-right">
                            @if (!$paxExceeded)
                                <a href="{{ route('public.reservations', [App::getLocale(), $property->property_id]) }}"
                                    class="btn btn-warning">{{ __('Book it!') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif($availabilityProperty == 'some')
            <div id="property-rate-info">
                <div class="alert alert-warning text-center"> {{ __('One or more nights are not available for dates') }}
                    <strong>{{ $bothDates }}</strong>,<br> {{ __('Please check the') }}
                    <a href="#" data-toggle="modal" data-source="{{ $property->property_id }}" data-year=""
                        data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}"
                        class="btn-calendar">
                        {{ __('Availability Calendar') }}
                    </a> {{ __('And edit your search.') }}
                </div>
            </div>
        @elseif($availabilityProperty == 'none')
            <div id="property-rate-info">
                <div class="alert alert-danger text-center"> {{ __('Not available for dates:') }}
                    <strong>{{ $bothDates }}</strong>,<br>
                    {{ __('Please check the') }}
                    <a href="#" data-toggle="modal" data-source="{{ $property->property_id }}" data-year=""
                        data-target="#{{ $modalID }}" title="{{ __('Availability Calendar') }}"
                        class="btn-calendar">
                        {{ __('Availability Calendar') }}
                    </a> {{ __('And edit your search.') }}
                </div>
        @endif
        <form
            action="{{ route('public.property-detail', [App::getLocale(), getZone($property->property_id), $property->slug]) }}"
            id="property-details-form" accept-charset="UTF-8">
            <div>
                <fieldset class="bg-success collapsible panel panel-default form-wrapper collapse-processed"
                    id="edit-details-form">
                    <legend class="panel-heading">
                        <a href="#edit-details-form-body" class="panel-title fieldset-legend collapsed"
                            data-toggle="collapse"><span
                                class="fieldset-legend-prefix element-invisible">{{ __('Hide') }}</span>{{ __('Check Availability') }}</a>
                    </legend>
                    <div class="panel-body panel-collapse collapse fade collapsed" id="edit-details-form-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-item form-item-arrival-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-arrival-sing">{{ __('Check in date') }}</label>
                                    <input class="text-center form-control form-text" readonly="readonly" type="text"
                                        id="edit-arrival-sing" name="arrival_sing"
                                        value="{{ $arrivalDeparture['arrivalTxt'] }}" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-item form-item-departure-sing form-type-textfield form-group"> <label
                                        class="control-label"
                                        for="edit-departure-sing">{{ __('Check out date') }}</label>
                                    <input class="text-center form-control form-text" readonly="readonly" type="text"
                                        id="edit-departure-sing" name="departure_sing"
                                        value="{{ $arrivalDeparture['departureTxt'] }}" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-item form-item-adults-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-adults-sing">{{ __('Adults') }}</label>
                                    <input class="form-control form-text" type="text" id="edit-adults-sing"
                                        name="adults_sing" value="" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-item form-item-children-sing form-type-textfield form-group"> <label
                                        class="control-label" for="edit-children-sing">{{ __('Children') }}</label>
                                    <input class="form-control form-text" type="text" id="edit-children-sing"
                                        name="children_sing" value="" size="60" maxlength="128">
                                </div>
                            </div>
                            <div class="col-xs-2 text-right">
                                <button title="{{ __('Check Availability') }}"
                                    class="btn btn-success btn-loading form-submit"
                                    data-loading-text="<i class=&quot;fa fa-spinner fa-spin&quot;></i>" type="submit"
                                    id="edit-submit" value="<i class=&quot;fas fa-search&quot;></i>"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <span class="summary"></span>
                </fieldset>
                <input id="arrival-alt-sing" type="hidden" name="arrival_alt_sing" value="">
                <input id="departure-alt-sing" type="hidden" name="departure_alt_sing" value="">
            </div>
        </form>
        <div id="property-details-info">
            <h2 class="section-title">{{ __('Details') }}</h2>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h4 class="sub-section">{{ __('Property Type') }}</h4>
                    <p>{{ $property->property->type->getLabel() }}</p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h4 class="sub-section">{{ __('Location') }}</h4>
                    <p>{{ getCity($property->property->city_id) }} / {{ $property->property->zone->getLabel() }} /
                        @if ($property->property->building()->exists())
                            {{ $property->property->building->name }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h4 class="sub-section">{{ __('Bedrooms') }} / {{ __('Bathrooms') }}</h4>
                    <p>{{ $property->property->bedrooms }} / {{ $property->property->baths }}</p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h4 class="sub-section">{{ __('Maid Service') }}</h4>
                    <p>{{ $property->property->cleaningOption->getLabel() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h4 class="sub-section">{{ __('Occupancy') }}</h4>
                    <p><span class="max-pax">{{ $property->property->pax }}</span>
                        {{ __('Guests max. (including children under 12 and babies)') }}</p>
                </div>

                @if(is_array($property->property->bedding))
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="sub-section">{{ __('Bedding') }}</h4>
                        <p>
                            @foreach($property->property->bedding as $bedType => $beds)
                                @if($beds > 0)
                                    {{ $bedType }}: {{ $beds }} 

                                    @if($property->property->bedding_notes[$bedType])
                                        <span>
                                            – {{ $property->property->bedding_notes[$bedType] }}
                                        </span>
                                    @endif

                                    <br>
                                @endif
                            @endforeach
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div id="property-description-info">
            <h2 class="section-title">{{ __('Highlights') }}</h2>
            {!! nl2br($property->description) !!}
        </div>
        <div id="property-features-info">
            <h2 class="section-title">{{ __('Services') }}</h2>
            <div class="row" style="display: block">
                {!! generateColumns($amenities, 8) !!}
            </div>
        </div>
        <div id="property-rates-info">
            <h2 class="section-title">{{ __('Rates') }}</h2>
            <table class="table table-striped table-hover property-rates">
                <thead>
                    <tr>
                        <th class="col-xs-4">{{ __('Period') }}</th>
                        <th class="col-xs-2">{{ __('Nightly') }}</th>
                        <th class="col-xs-2">{{ __('Weekly') }}</th>
                        <th class="col-xs-2">{{ __('Monthly') }}</th>
                        <th class="col-xs-2">{{ __('Min. Stay') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rates as $i => $rate)
                        @php
                            $rateStart = \Carbon\Carbon::parse(strtotime($rate->start_date));
                            $rateEnd = \Carbon\Carbon::parse(strtotime($rate->end_date));
                            $resultStart = $rateStart->gt($currentDate);
                            $resultEnd = $rateEnd->gt($currentDate);
                            $startDate = \Carbon\Carbon::parse(strtotime($rate->start_date))->format('d/M/Y');
                            $endDate = \Carbon\Carbon::parse(strtotime($rate->end_date))->format('d/M/Y');
                            if(!$resultStart && !$resultEnd){
                                continue;
                            }
                        @endphp
                        {{-- <tr class="{{ $i > 4 ? 'toggle-table-rates' : '' }}"> --}}
                        <tr>
                            <td>{{ $startDate }} - {{ $endDate }}</td>
                            <td>{{ priceFormat($rate->nightly) }}</td>
                            <td>{{ priceFormat($rate->weekly) }}</td>
                            <td>{{ priceFormat($rate->monthly) }}</td>
                            <td>{{ $rate->min_stay }} {{ __('Nights') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row rates-footer">
                <div class="col-xs-9"><small><i>* {{ __('All rates in USD tax included.') }}</i></small></div>
                {{-- @if (count($property->property->rates) > 5)
                    <div class="col-xs-3 text-right">
                        <small>
                            <a href="# " id="toggle-rates" title="{{ __('More rates') }}"
                                data-more-rates="{{ __('More rates') }}" data-less-rates="{{ __('Less rates') }}"
                                class="show-rates">{{ __('More rates') }}</a>
                        </small>
                    </div>
                @endif --}}
            </div>
        </div>
        <div id="property-calendar-info">
            <h2 class="section-title">{{ __('Calendar') }}</h2>
            <div class="cal-month first-calendar" data-url="{{ route('public.first-availability', [App::getLocale()]) }}">
            </div>
            <div class="text-right cal-more-dates">
                <a href="#" class="btn btn-warning btn-calendar" data-toggle="modal"
                    data-source="{{ $property->property_id }}" data-year="" data-target="#{{ $modalID }}"
                    title="{{ __('More Dates') }}">
                    {{ __('More Dates') }}
                </a>
            </div>
        </div>
        <div id="property-map-info" class="app-map-wrapper">
            <h2 class="section-title">{{ __('Location') }}</h2>
            <div id="{{ $property->property_id }}" class="app-google-map" data-lat="{{ $latitude }}"
                data-lng="{{ $longitude }}" data-map-id="{{ $property->property_id }}"></div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection

@section('bottom-js')
    <script>
        var property = JSON.parse('<?= $prw ?>');
        var propertyAvailability = JSON.parse('<?= $searchAvailability ?>');

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmvl4FUJzyTt-JWxurpF7Tx0f-5kK2MJs" async defer>
    </script>
    <script src="{{ asset('assets/public/js/gmaps.js') }}"></script>
    <script src="{{ asset('assets/public/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('assets/public/js/property-detail.js') }}"></script>

@endsection
