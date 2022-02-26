@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('Reservations');
    $datesProperty = explode(',', $_COOKIE['datesProperty']);
    if(isset($_COOKIE['singleProperty'])){
        $singleProperty = explode(',', $_COOKIE['singleProperty']);
    }else{
        $singleProperty = [];
    }
    if (isset($_COOKIE['singleProperty']) && !empty($singleProperty[0])) {
        $arrival = $singleProperty[0];
        $arrivalTxt = $singleProperty[1];
        $departure = $singleProperty[2];
        $departureTxt = $singleProperty[3];
        $adults = $singleProperty[4] ? $singleProperty[4] : 0;
        $children = $singleProperty[5] ? $singleProperty[5] : 0;
    } else {
        $arrival = $datesProperty[0];
        $arrivalTxt = $datesProperty[1];
        $departure = $datesProperty[2];
        $departureTxt = $datesProperty[3];
        $adults = $datesProperty[4] ? $datesProperty[4] : 0;
        $children = $datesProperty[5] ? $datesProperty[5] : 0;
    }
    
    $availabilityProperty = getAvailabilityProperty($property->property_id, $arrival, $departure);
    $nightsDate = \RatesHelper::getTotalBookingDays($arrival, $departure);
    $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    $latitude = $property->property->gmaps_lat;
    $longitude = $property->property->gmaps_lon;
    $featuredImage = getFeaturedImage($property->property_id);

    $propertyRate = \RatesHelper::getPropertyRate($property->property, $property->property->rates, $arrival, $departure);
    
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="reservations">
        <div class="form-header"> <i class="glyphicon glyphicon-calendar"></i> {{ __('Booking') }} -
            {{ $property->name }} <br>
            <span class="form-header-sub">{{ $property->property->type->getLabel() }} / {{ __('Bedrooms') }}
                {{ $property->property->bedrooms }} / {{ __('Baths') }}
                {{ $property->property->baths }} / {{ __('Pax') }}
                {{ $property->property->pax }}</span>
        </div>
        <form action="{{ route('public.make-reservation', [App::getLocale()]) }}" method="post" id="bookings-form" accept-charset="UTF-8">
            @csrf
            <input type="hidden" value="{{ $property->property_id }}" name="property_id">
            <input type="hidden" value="{{ $arrival }}" name="arrival_date">
            <input type="hidden" value="{{ $departure }}" name="departure_date">
            <input type="hidden" value="{{ $adults }}" name="adults">
            <input type="hidden" value="{{ $children }}" name="children">
            <input type="hidden" value="{{ $propertyRate['nightlyAppliedRate'] }}" name="price_per_night">
            <input type="hidden" value="{{ $propertyRate['totalDays'] }}" name="nights">
            <input type="hidden" value="{{ $propertyRate['total'] }}" name="subtotal_nights">
            <div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>{{ __('Guest Details') }}</span></div>
                        <div class="form-item form-item-b-first-name form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input placeholder="{{ __('First name') }}" class="form-control form-text" type="text"
                                    name="firstname" value="{{ old('firstname') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-last-name form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input placeholder="{{ __('Last name') }}" class="form-control form-text" type="text"
                                    name="lastname" value="{{ old('lastname') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-email form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input placeholder="{{ __('Email address') }}" class="form-control form-text" type="text"
                                    name="email" value="{{ old('email') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-email-confirm form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input placeholder="{{ __('Confirm email') }}" class="form-control form-text" type="text"
                                    name="email_confirmation" value="{{ old('email_confirmation') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-phone form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone-alt"></span>
                                </span>
                                <input placeholder="{{ __('Telephone') }}" class="form-control form-text" type="text"
                                    name="phone" value="{{ old('phone') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-mobil form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone"></span>
                                </span>
                                <input placeholder="{{ __('Mobile') }}" class="form-control form-text" type="text"
                                    name="mobile" value="{{ old('mobile') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>{{ __('Address') }}</span></div>
                        <div class="form-item form-item-b-address form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-home"></span>
                                </span>
                                <input placeholder="{{ __('Street address') }}" class="form-control form-text"
                                    type="text" name="street" value="{{ old('street') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-city form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-stats"></span>
                                </span>
                                <input placeholder="{{ __('City') }}" class="form-control form-text" type="text"
                                    name="city" value="{{ old('city') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-state form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </span>
                                <input placeholder="{{ __('State') }}" class="form-control form-text" type="text"
                                    name="state" value="{{ old('state') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-postal form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pushpin"></span>
                                </span>
                                <input placeholder="{{ __('Postal code') }}" class="form-control form-text" type="text"
                                    name="zip" value="{{ old('zip') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-country form-type-select form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-globe"></span>
                                </span>
                                <select class="form-control form-select" name="country">
                                    <option value="">{{ __('Select country...') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}"
                                            {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row b-comments">
                    <div class="col-xs-12">
                        <div class="form-item form-item-b-comments form-type-textarea form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </span>
                                <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                                    <textarea placeholder="{{ __('Comments') }}" class="form-control form-textarea"
                                        name="comments" cols="60" rows="4">{{ old('comments') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>{{ __('Flight Information') }}</span></div>
                        <div class="alert alert-info">{{ __('Dont have flight information') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-airline form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-plane"></span>
                                </span>
                                <input placeholder="{{ __('Arrival Airline') }}" class="form-control form-text"
                                    type="text" name="arrival_airline" value="{{ old('arrival_airline') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-airline form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-plane"></span>
                                </span>
                                <input placeholder="{{ __('Departure Airline') }}" class="form-control form-text"
                                    type="text" name="departure_airline" value="{{ old('departure_airline') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-flight form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </span>
                                <input placeholder="{{ __('Arrival Flight Number') }}" class="form-control form-text"
                                    type="text" name="arrival_flight_number" value="{{ old('arrival_flight_number') }}"
                                    size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-flight form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </span>
                                <input placeholder="{{ __('Departure Flight Number') }}" class="form-control form-text"
                                    type="text" name="departure_flight_number"
                                    value="{{ old('departure_flight_number') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-time form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                <input placeholder="{{ __('Arrival Time') }}" class="form-control form-text" type="text"
                                    name="arrival_time" value="{{ old('arrival_time') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-time form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                <input placeholder="{{ __('Departure Time') }}" class="form-control form-text"
                                    type="text" name="departure_time" value="{{ old('departure_time') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>{{ __('Damage Deposit') }}</span></div>
                        <div class="alert alert-info">{{ __('We strongly suggest for you to purchase') }} <a
                                href="{{ route('public.vacation-services.accidental-rental-damage-insurance', [App::getLocale()]) }}"
                                title="{{ __('Accidental Rental Damage Insurance') }}"
                                target="_blank">{{ __('Accidental Rental Damage Insurance') }}</a>,
                            {{ __('if you decide not to use Accidental Rental Damage Insurance, you will then be required to make a $500.00 USD damage deposit with your payment.') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-item form-item-b-insurance form-type-radios form-group">
                            <!-- damage_deposit_id -->
                            @include('components.form.select', [
                            'group' => 'booking',
                            'label' => __('Damage Deposit'),
                            'name' => 'damage_deposit_id',
                            'options' => $damageDeposits,
                            'disableDefaultOption' => true,
                            'optionValueRef' => 'damage_deposit_id',
                            'optionLabelRef' => 'description',
                            ])
                        </div>
                    </div>
                </div>
                <div class="row agreement">
                    <div class="col-xs-12">
                        <div class="alert alert-info">
                            <div class="form-item form-item-agreement form-type-checkbox checkbox">
                                <label class="control-label" for="agreement">
                                    <input type="checkbox" name="agreement" id="agreement"
                                        {{ old('agreement') == 'on' ? 'checked' : '' }}
                                        class="form-checkbox">{{ __('Please read and agree to our') }} <a
                                        href="{{ route('public.vacation-services.rental-agreement', [App::getLocale()]) }}"
                                        title="{{ __('Rental Agreement') }}"
                                        target="_blank">{{ __('Rental Agreement') }}</a>, {{ __('Our') }} <a
                                        href="{{ route('public.about.privacy-policy', [App::getLocale()]) }}"
                                        title="{{ __('Privacy Policy') }}"
                                        target="_blank">{{ __('Privacy Policy') }}</a> {{ __('And our') }} <a
                                        href="{{ route('public.about.terms-of-use', [App::getLocale()]) }}"
                                        title="{{ __('Terms of Use') }}" target="_blank">{{ __('Terms of Use') }}</a>
                                    {{ __('To complete your reservation request.') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="captcha">
                    <div class="captcha-code">
                        {{ $captcha }}
                    </div>
                    <input type="hidden" value="{{ $captcha }}" name="code_catpcha">
                    <div class="form-item form-item-captcha-response form-type-textfield form-group"> <label
                            class="control-label" for="edit-captcha-response">{{ __('What code is in the image?') }}
                            <span class="form-required" title="{{ __('This field is required.') }}">*</span></label>
                        <input class="form-control form-text" name="captcha_response" size="15" maxlength="128"
                            autocomplete="off" placeholder="{{ __('Enter the characters shown in the image.') }}">
                    </div>
                </div>
                <div class="form-actions form-wrapper form-group" id="edit-actions"><button
                        title="{{ __('Make Booking') }}" class="btn btn-success btn-loading form-submit"
                        data-loading-text="<i class=&quot;fa fa-spinner fa-spin&quot;></i> ... {{ __('One moment please') }}"
                        type="submit" id="edit-submit" name="op"
                        value="{{ __('Make Booking') }}">{{ __('Make Booking') }}</button>
                </div>
            </div>
        </form>
    </div>

    @include('public.pages.partials.main-content-end-booking')

    @include('public.pages.partials.footer')

@endsection

@section('bottom-js')
    <script src="{{ asset('assets/public/js/captchaImage.js') }}"></script>
@endsection
