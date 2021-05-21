@extends('layouts.horizontal-master')

@section('heading-content')
    @php
        $actions = [];
    @endphp

    @include('components.heading', [
        'label' => __('Rates Calculator'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    {{-- search form --}}
    <form action="{{ route('property-bookings.rates-calculator-calculate') }}" method="post">
        @csrf

        <div class="row row-xs">
            {{-- property --}}
            <div class="col-md-3 select-filter">
                <label for="from_date">
                    {{ __('Property') }}*
                </label>

                <select name="property_id" class="form-control">
                    @foreach($properties as $property)
                        <option value="{{ $property->property_id }}">
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <!-- from_date -->
            <div class="col-md-3 select-filter">
                <label for="from_date">
                    {{ __('From') }}*
                </label>
                <input id="from_date" type="text" name="from_date" value="2021-06-01" 
                    data-max-days-limit-from-now="1460"
                    class="form-control app-input-datepicker" data-format="yyyy-mm-dd" required>
            </div>

            {{-- to date --}}
            <div class="col-md-3 select-filter">
                <label for="to_date">
                    {{ __('To') }}*
                </label>
                <input id="to_date" type="text" name="to_date" value="2021-09-14" 
                    data-max-days-limit-from-now="1460"
                    class="form-control app-input-datepicker" data-format="yyyy-mm-dd" required>
            </div>

            <div class="col-md-2 app-search-buttons">
                <div style="display: block; margin-bottom: 7px">
                    &nbsp;
                </div>
                <button class="btn btn-dark btn-icon mr-2" type="submit">
                    <span class="ul-btn__icon">
                        <i class="i-Magnifi-Glass1"></i>
                    </span>
                </button>
            </div>
        </div>

    </form>

    <!-- separator -->
    <div class="mb-4"></div>

    @if($rates)
        @include('property-rates.partials.table', [
            'label' => __('Rates'),
            'rows' => $rates
        ])
    @endif

    <!-- separator -->
    <div class="mb-4"></div>

    <div class="col-12 col-md-6 pl-0">
        <table class="table">
            <tbody>
                <tr>
                    <th>{{ __('From') }}</th>
                    <td>{{ $from_date }}</td>
                </tr>

                <tr>
                    <th>{{ __('To') }}</th>
                    <td>{{ $to_date }}</td>
                </tr>

                <tr>
                    <th>{{ __('Total Days') }}</th>
                    <td>{{ $propertyRate['totalDays'] }}</td>
                </tr>

                <tr>
                    <th>{{ __('Total') }}</th>
                    <td>{{ number_format($propertyRate['total'], 2) }}</td>
                </tr>

                <tr>
                    <th>{{ __('Nightly Current Rate') }}</th>
                    <td>{{ $propertyRate['nightlyCurrentRate'] }}</td>
                </tr>

                <tr>
                    <th>{{ __('Nightly Applied Rate') }}</th>
                    <td>{{ $propertyRate['nightlyAppliedRate'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
