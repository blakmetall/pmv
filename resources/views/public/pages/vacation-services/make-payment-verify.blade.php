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
                            {{ __('avg. night') }}
                        </div>
                    </div>
                    @if (!$paid)
                        <div class="row" style="">
                            <label class="col-sm-12 col-form-label"
                                style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                                {{ __('$45.00 USD per property plan (Covers up to: $1,500.00 USD)') }}
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
                        {{ priceFormat(45) }} USD
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <label style="font-size: 12px;color: #5e7180;margin-bottom: 4px;">
                        {{ __('Total') }}
                    </label><br>
                    {{ priceFormat($total) }} USD
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
        <form #target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="make-payment-form"
            accept-charset="UTF-8">
            <div>
                <input type="hidden" name="cmd" value="_xclick">
                {{-- QUITAR ESTO CUANDO YA VAYA A FUNCIONAR
                --}}
                {{-- <input type="hidden" name="business" value="4VTZ68GP74YXU">
                --}}
                <input type="hidden" name="charset" value="utf-8">
                <input type="hidden" name="return" value="{{ route('public.vacation-services.thank-you') }}">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="item_name"
                    value="{{ $property->name }} {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} Night(s)">
                <input type="hidden" name="cbt" value="{{ __('CLICK HERE TO COMPLETE YOUR ORDER!') }}">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="invoice" value="{{ $booking->id }}">
                <input type="hidden" name="address1" value="{{ $booking->street }}">
                <input type="hidden" name="address2">
                <input type="hidden" name="city" value="{{ $booking->city }}">
                <input type="hidden" name="first_name" value="{{ $booking->firstname }}">
                <input type="hidden" name="last_name" value="{{ $booking->lastname }}">
                <input type="hidden" name="zip" value="{{ $booking->zip }}">
                <div class="form-item form-item-amount form-type-select form-group">
                    <select class="form-control form-select required" id="edit-amount" name="amount">
                        <option value="{{ $total }}">{{ priceFormat($total) }} USD
                            ({{ __('FULL PAYMENT') }})</option>
                        <option value="{{ $mid }}">{{ priceFormat($mid) }} USD (50%)</option>
                    </select>
                    <label class="control-label element-invisible" for="edit-amount">{{ __('Select Amount') }}<span
                            class="form-required" title="This field is required.">*</span></label>
                </div>
                <button type="submit" id="edit-next" name="op" value="{{ __('Make Payment') }}"
                    class="btn btn-default form-submit">{{ __('Make Payment') }}</button>
                <a href="{{ route('public.vacation-services.make-payment') }}" class="btn btn-default form-submit"
                    role="button">
                    {{ __('Find Another Reservation') }}
                </a>
            </div>
        </form>
    @else
        <a href="{{ route('public.vacation-services.make-payment') }}" class="btn btn-default form-submit" role="button">
            {{ __('Find Another Reservation') }}
        </a>
    @endif

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
