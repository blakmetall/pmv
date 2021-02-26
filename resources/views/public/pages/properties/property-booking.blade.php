@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = 'Reservations';
    $datesProperty = explode(',', $_COOKIE['datesProperty']);
    $singleProperty = explode(',', $_COOKIE['singleProperty']);
    if (!empty($singleProperty[0])) {
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
    $subtotal = \RatesHelper::getNightsSubtotalCost($property->property, $arrival, $departure);
    $availabilityProperty = getAvailabilityProperty($property->property_id, $arrival, $departure);
    $nightlyRate = \RatesHelper::getNightlyRate($property->property, null, $arrival, $departure);
    $nightsDate = \RatesHelper::getTotalBookingDays($arrival, $departure);
    $modalID = 'calendar-availability-' . strtotime('now') . rand(1, 99999);
    $latitude = $property->property->gmaps_lat;
    $longitude = $property->property->gmaps_lon;
    $featuredImage = getFeaturedImage($property->property_id);
    @endphp

    @include('public.pages.partials.main-content-start')

    <div id="reservations">
        <div class="form-header"> <i class="glyphicon glyphicon-calendar"></i> Booking - {{ $property->name }} <br>
            <span class="form-header-sub">{{ $property->property->type->getLabel() }} / Bedrooms
                {{ $property->property->bedrooms }} / Baths
                {{ $property->property->baths }} / Sleeps
                {{ $property->property->sleeps }}</span>
        </div>
        <form action="{{ route('public.make-reservation') }}" method="post" id="bookings-form" accept-charset="UTF-8">
            @csrf
            <input type="hidden" value="{{ $property->property_id }}" name="property_id">
            <input type="hidden" value="{{ $arrival }}" name="arrival_date">
            <input type="hidden" value="{{ $departure }}" name="departure_date">
            <input type="hidden" value="{{ $adults }}" name="adults">
            <input type="hidden" value="{{ $children }}" name="children">
            <input type="hidden" value="{{ $nightlyRate }}" name="price_per_night">
            <input type="hidden" value="{{ $nightsDate }}" name="nights">
            <input type="hidden" value="{{ $subtotal }}" name="subtotal_nights">
            <div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>Guest Details</span></div>
                        <div class="form-item form-item-b-first-name form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input placeholder="First name" class="form-control form-text" type="text" name="firstname"
                                    value="{{ old('firstname') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-last-name form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input placeholder="Last name" class="form-control form-text" type="text" name="lastname"
                                    value="{{ old('lastname') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-email form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input placeholder="Email address" class="form-control form-text" type="text" name="email"
                                    value="{{ old('email') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-email-confirm form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input placeholder="Confirm email" class="form-control form-text" type="text"
                                    name="email_confirmation" value="{{ old('email_confirmation') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-phone form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone-alt"></span>
                                </span>
                                <input placeholder="Telephone" class="form-control form-text" type="text" name="phone"
                                    value="{{ old('phone') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-mobil form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone"></span>
                                </span>
                                <input placeholder="Mobile" class="form-control form-text" type="text" name="mobile"
                                    value="{{ old('mobile') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="hr-tagline"><span>Address</span></div>
                        <div class="form-item form-item-b-address form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-home"></span>
                                </span>
                                <input placeholder="Street address" class="form-control form-text" type="text" name="street"
                                    value="{{ old('street') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-city form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-stats"></span>
                                </span>
                                <input placeholder="City" class="form-control form-text" type="text" name="city"
                                    value="{{ old('city') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-state form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </span>
                                <input placeholder="State" class="form-control form-text" type="text" name="state"
                                    value="{{ old('state') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-postal form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pushpin"></span>
                                </span>
                                <input placeholder="Postal code" class="form-control form-text" type="text" name="zip"
                                    value="{{ old('zip') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-country form-type-select form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-globe"></span>
                                </span>
                                <select class="form-control form-select" name="country">
                                    <option value="">Select country...</option>
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
                                    <textarea placeholder="Comments" class="form-control form-textarea" name="comments"
                                        cols="60" rows="4">{{ old('comments') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>Flight Information</span></div>
                        <div class="alert alert-info">If you don't have your flight information at this time please leave
                            the fields blank, you can give us this information at a later time.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-airline form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-plane"></span>
                                </span>
                                <input placeholder="Arrival airline" class="form-control form-text" type="text"
                                    name="arrival_airline" value="{{ old('arrival_airline') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-airline form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-plane"></span>
                                </span>
                                <input placeholder="Departure airline" class="form-control form-text" type="text"
                                    name="departure_airline" value="{{ old('departure_airline') }}" size="60"
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
                                <input placeholder="Arrival flight number" class="form-control form-text" type="text"
                                    name="arrival_flight_number" value="{{ old('arrival_flight_number') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-flight form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </span>
                                <input placeholder="Departure flight number" class="form-control form-text" type="text"
                                    name="departure_flight_number" value="{{ old('departure_flight_number') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-item form-item-b-arrival-time form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                <input placeholder="Arrival time" class="form-control form-text" type="text"
                                    name="arrival_time" value="{{ old('arrival_time') }}" size="60" maxlength="128" />
                            </div>
                        </div>
                        <div class="form-item form-item-b-departure-time form-type-textfield form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                <input placeholder="Departure time" class="form-control form-text" type="text"
                                    name="departure_time" value="{{ old('departure_time') }}" size="60"
                                    maxlength="128" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="hr-tagline"><span>Damage Deposit</span></div>
                        <div class="alert alert-info">We strongly suggest for you to purchase <a
                                href="{{ route('public.vacation-services.accidental-rental-damage-insurance') }}"
                                title="Accidental Rental Damage Insurance" target="_blank">Accidental Rental Damage
                                Insurance</a>, if you decide not to use Accidental
                            Rental Damage Insurance, you will then be required to make a $500.00 USD damage deposit with
                            your payment.</div>
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
                                    <input type="checkbox" name="agreement"
                                        {{ old('agreement') == 'on' ? 'checked' : '' }} class="form-checkbox">Please read
                                    and
                                    agree to our <a href="{{ route('public.vacation-services.rental-agreement') }}"
                                        title="Rental Agreement" target="_blank">Rental Agreement</a>, our <a
                                        href="{{ route('public.about.privacy-policy') }}" title="Privacy Policy"
                                        target="_blank">Privacy Policy</a> and
                                    our <a href="{{ route('public.about.terms-of-use') }}" title="Terms of Use"
                                        target="_blank">Terms of Use</a> to
                                    complete your reservation request.</label>
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
                            class="control-label" for="edit-captcha-response">What code is in the image?
                            <span class="form-required" title="This field is required.">*</span></label>
                        <input class="form-control form-text" name="captcha_response" size="15" maxlength="128"
                            autocomplete="off" placeholder="Enter the characters shown in the image.">
                    </div>
                </div>
                <div class="form-actions form-wrapper form-group" id="edit-actions"><button title="Make Booking"
                        class="btn btn-success btn-loading form-submit"
                        data-loading-text="<i class=&quot;fa fa-spinner fa-spin&quot;></i> ... one moment please"
                        type="submit" id="edit-submit" name="op" value="Make Booking">Make Booking</button>
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
