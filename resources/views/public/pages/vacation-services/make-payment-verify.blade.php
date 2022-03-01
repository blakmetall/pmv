@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('MAKE PAYMENT');
    @endphp

    @include('public.pages.partials.main-content-start')

    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Concept') }}</th>
                <th>{{ __('Amount') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">
                    <div class="row" style="">
                        <label class="col-sm-3 col-form-label" style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                            {{ __('Reservation') }}
                        </label>

                        <div class="col-sm-9">
                            #{{ $booking->id }}
                        </div>
                    </div>
                    <div class="row" style="">
                        <label class="col-sm-3 col-form-label" style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                            {{ __('Guest') }}
                        </label>

                        <div class="col-sm-9">
                            {{ $booking->full_name }}
                        </div>
                    </div>
                    <div class="row" style="">
                        <label class="col-sm-3 col-form-label" style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                            {{ __('Property') }}
                        </label>

                        <div class="col-sm-9">
                            {{ $property->name }}
                        </div>
                    </div>
                    <div class="row" style="">
                        <label class="col-sm-3 col-form-label" style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                            {{ __('Travel Dates') }}
                        </label>

                        <div class="col-sm-9">
                            {{ $booking->arrival_date }} - {{ $booking->departure_date }}
                            ({{ $booking->nights }}) @ {{ priceFormat($booking->price_per_night) }} USD
                            {{ __('Avg. night') }}
                        </div>
                    </div>
                    @if (!$paid)
                        <div class="row" style="">
                            <label class="col-sm-12 col-form-label"
                                style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                                {{ $booking->damageDeposit->translate()->description }}
                            </label>
                        </div>
                    @endif
                </td>
                <td>
                    {{ priceFormat($booking->total) }} USD
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    @if (!$paid)
                        {{ priceFormat($booking->subtotal_damage_deposit) }} USD
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <label style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                        {{ __('Total') }}
                    </label><br>
                    {{ priceFormat($rest) }} USD
                </td>
            </tr>
        </tbody>
    </table>
    @if (!$paid)
        <div style="font-size: 12px;">
            {{ __('Information Payment') }}
            <br><br>
            <ul>
                <li>Puerto Vallarta: 1-800-881-8176</li>
                <li>Mazatlán: 1-888-688-1577</li>
            </ul>
        </div>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="accounting@palmeravacations.com">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="item_name" value="{{ $property->name }} {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} {{ __('Nights') }}">
            <div class="form-item form-item-amount form-type-select form-group">
                <select class="form-control form-select required" id="edit-amount" name="amount">
                    <option value="{{ $rest }}">{{ priceFormat($rest) }} USD
                        ({{ __('FULL PAYMENT') }})</option>
                    <option value="{{ $mid }}">{{ priceFormat($mid) }} USD (50%)</option>
                </select>
                <label class="control-label element-invisible" for="edit-amount">{{ __('Select Amount') }}<span
                        class="form-required" title="{{ __('This field is required.') }}">*</span></label>
            </div>
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="return" value="{{ route('public.vacation-services.thank-you', [App::getLocale()]) }}">
            <input type="hidden" name="rm" value="2">
            <input type="hidden" name="notify_url" value="{{ route('public.vacation-services.thank-you', [App::getLocale()]) }}">
            <input type="hidden" name="cancel_return" value="{{ route('public.vacation-services.make-payment-verify', [App::getLocale(), $booking->id]) }}">
            <input type="hidden" name="page_style" value="primary">
            <input type="hidden" name="lc" value="US">
            <input type="hidden" name="country" value="US">
            <input type="hidden" name="lang" value="en">
            <input type="hidden" name="type" value="false">
            <button type="submit" id="edit-next" value="{{ __('Make Payment') }}"
                    class="btn btn-default form-submit">{{ __('Make Payment') }}</button>
            <a href="{{ route('public.vacation-services.make-payment', [App::getLocale()]) }}" class="btn btn-default form-submit"
                role="button">
                {{ __('Find Another Reservation') }}
            </a>
        </form>
    @else
        <a href="{{ route('public.vacation-services.make-payment', [App::getLocale()]) }}" class="btn btn-default form-submit" role="button">
            {{ __('Find Another Reservation') }}
        </a>
    @endif

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
