@extends('layouts.public-master')

@section('page-css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
@endsection

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = $page->translate()->title;
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        {!! $page->translate()->description !!}
                        <h2><i class="fa fa-comments"></i> {{ __('Get in touch') }}</h2>
                    </div>
                </div>
                <br>
                <div class="panel-pane pane-contact">
                    <div class="pane-content">
                        <form class="user-info-from-cookie contact-form user-info-from-cookie-processed"
                            action="{{ route('public.contact.send-email', [App::getLocale()]) }}" method="post" id="contact-site-form"
                            accept-charset="UTF-8">
                            <div>
                                <div class="form-item form-item-name form-type-textfield form-group">
                                    <label class="control-label" for="edit-name">{{ __('Your name') }} <span
                                            class="form-required"
                                            title="{{ __('This field is required.') }}">*</span></label>
                                    <input class="form-control form-text" type="text" id="edit-name" name="name"
                                        value="{{ old('name') }}" size="60" maxlength="255" required>
                                </div>
                                <div class="form-item form-item-mail form-type-textfield form-group"> <label
                                        class="control-label" for="edit-mail">{{ __('Your e-mail address') }} <span
                                            class="form-required"
                                            title="{{ __('This field is required.') }}">*</span></label>
                                    <input class="form-control form-text" type="text" id="edit-mail" name="mail"
                                        value="{{ old('mail') }}" size="60" maxlength="255" required>
                                </div>
                                <div class="form-item form-item-subject form-type-textfield form-group"> <label
                                        class="control-label" for="edit-subject">{{ __('Subject') }} <span
                                            class="form-required"
                                            title="{{ __('This field is required.') }}">*</span></label>
                                    <input class="form-control form-text" type="text" id="edit-subject" name="subject"
                                        value="{{ old('subject') }}" size="60" maxlength="255" required>
                                </div>
                                <div class="form-item form-item-cid form-type-select form-group"> <label
                                        class="control-label" for="edit-cid">{{ __('Category') }} <span
                                            class="form-required"
                                            title="{{ __('This field is required.') }}">*</span></label>
                                    <select class="form-control form-select" id="edit-cid" name="category" required>
                                        <option value="">- {{ __('Please choose') }} -</option>
                                        <option value="1" {{ old('category') == 1 ? 'selected' : '' }}>
                                            {{ __('Accounting') }}
                                        </option>
                                        <option value="2" {{ old('category') == 2 ? 'selected' : '' }}>
                                            {{ __('Concierge') }}
                                        </option>
                                        <option value="3" {{ old('category') == 3 ? 'selected' : '' }}>
                                            {{ __('Property Management') }}
                                        </option>
                                        <option value="4" {{ old('category') == 4 ? 'selected' : '' }}>
                                            {{ __('Vacation Services / Reservations') }}
                                        </option>
                                        <option value="5" {{ old('category') == 5 ? 'selected' : '' }}>
                                            {{ __('Website feedback') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-item form-item-message form-type-textarea form-group"> <label
                                        class="control-label" for="edit-message">{{ __('Message') }} <span
                                            class="form-required"
                                            title="{{ __('This field is required.') }}">*</span></label>
                                    <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control form-textarea" id="edit-message" name="message"
                                            cols="60" rows="5" required>{{ old('message') }}</textarea>
                                        <div class="grippie"></div>
                                    </div>
                                </div>
                                <div class="captcha">
                                    <div class="captcha-code">
                                        {{ $captcha }}
                                    </div>
                                    <input type="hidden" value="{{ $captcha }}" name="code_catpcha">
                                    <div class="form-item form-item-captcha-response form-type-textfield form-group"> <label
                                            class="control-label"
                                            for="edit-captcha-response">{{ __('What code is in the image?') }} <span
                                                class="form-required"
                                                title="{{ __('This field is required.') }}">*</span></label>
                                        <input class="form-control form-text" name="captcha_response" size="15"
                                            maxlength="128" autocomplete="off"
                                            placeholder="{{ __('Enter the characters shown in the image.') }}">
                                    </div>
                                </div>
                                <div class="form-actions form-wrapper form-group" id="edit-actions">
                                    <button type="submit" id="edit-submit" value="{{ __('Send message') }}"
                                        class="btn btn-default form-submit">{{ __('Send message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-pane pane-custom pane-2">
                    <div class="pane-content">
                        <div class="hr-tagline"><span>{{ __('Our Locations') }}</span></div>
                    </div>
                </div>
                <div class="panel-pane pane-custom pane-3">
                    <div class="pane-content">
                        <div class="row">
                            @foreach ($offices as $office)
                                <div class="col-xs-6 mb-4">
                                    {!! $office['address'] !!}<br />
                                    <span>{{ __('Phone Local') }}:</span> {{ $office['phone'] }}<br>
                                    @if ($office['phone_us_can'])
                                        <span>{{ __('Phone US & CAN') }}:</span> {{ $office['phone_us_can'] }}<br>
                                    @endif
                                    @if ($office['phone_free'])
                                        <span>{{ __('Phone Free') }}:</span> {{ $office['phone_free'] }}<br>
                                    @endif
                                    <span>{{ __('Email') }}:</span> <a
                                        href="mailto:{{ $office['email'] }}">{{ $office['email'] }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-separator"></div>
                <div class="panel-pane pane-custom pane-4">
                    <div class="pane-content">
                        <div class="row">
                            @foreach ($offices as $office)
                                @php
                                    $id = $office['gmaps_id'];
                                    $latitude = $office['gmaps_lat'];
                                    $longitude = $office['gmaps_lon'];
                                @endphp
                                <div class="col-xs-6 app-map-wrapper">
                                    <h4>{{ __('Location Map') }}</h4>
                                    <div id="{{ $id }}" class="app-google-map" data-lat="{{ $latitude }}" data-lng="{{ $longitude }}" data-map-id="{{ $id }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection

@section('bottom-js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmvl4FUJzyTt-JWxurpF7Tx0f-5kK2MJs" async defer>
    </script>
    <script src="{{ asset('assets/public/js/gmaps.js') }}"></script>
    <script src="{{ asset('assets/public/js/captchaImage.js') }}"></script>
@endsection
