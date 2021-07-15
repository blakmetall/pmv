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
    <form action="{{ route('property-bookings.rates-calculator') }}" method="get">
        <div class="row row-xs">
            {{-- property --}}
            <div class="col-md-3 select-filter">
                <label for="from_date">
                    {{ __('Property') }}*
                </label>

                <select name="property_id" class="form-control">
                    @foreach($properties as $property)
                        <option 
                            value="{{ $property->property_id }}" 
                            <?=($propertyID == $property->property_id) ? 'selected="selected"' : ''?>
                            >
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
                <input id="from_date" type="text" name="from_date" value="{{ $from_date }}" 
                    data-max-days-limit-from-now="1460"
                    class="form-control app-input-datepicker" data-format="yyyy-mm-dd" required>
            </div>

            {{-- to date --}}
            <div class="col-md-3 select-filter">
                <label for="to_date">
                    {{ __('To') }}*
                </label>
                <input id="to_date" type="text" name="to_date" value="{{ $to_date }}" 
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

    <h4>{{ __('Rate') }}</h4>

    <div class="col-12 col-md-6 pl-0 mb-5">
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
                    <th>{{ __('Total Nights') }}</th>
                    <td>{{ $propertyRate['totalDays'] }}</td>
                </tr>

                <tr>
                    <th>{{ __('Total') }}</th>
                    <td><b>${{ number_format($propertyRate['total'], 2) }}</b></td>
                </tr>

                <tr>
                    <th>{{ __('Nightly Current Rate') }}</th>
                    <td>${{ $propertyRate['nightlyCurrentRate'] }}</td>
                </tr>

                <tr>
                    <th>{{ __('Nightly Applied Rate') }}</th>
                    <td>${{ $propertyRate['nightlyAppliedRate'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4>{{ __('Applied Rates') }}</h4>

    <div>
        <table class="table">
            <thead>
                <th>{{ __('Rate ID') }}</th>
                <th>{{ __('Nights') }}</th>
                <th>{{ __('Weeks') }}</th>
                <th>{{ __('Months') }}</th>
                <th class="text-right">{{ __('Subtotal') }}</th>
            </thead>

            <tbody>
                @if(isset($propertyRate['ratesPrices']) && count($propertyRate['ratesPrices']))
                    @php $total = 0; @endphp

                    @foreach($propertyRate['ratesPrices'] as $rateId => $rate)
                        <tr>
                            <td><b>#{{ $rateId }}</b></td>
                            <td>
                                @if(isset($rate['nights']))
                                    {{ $rate['nights'] }} * {{ $rate['nightlyRate'] }}
                                @endif
                            </td>
                            <td>
                                @if(isset($rate['weeks']))
                                    {{ $rate['weeks'] }} * {{ $rate['weeklyRate'] }}
                                @endif
                            </td>
                            <td>    
                                @if(isset($rate['months']))
                                    {{ $rate['months'] }} * {{ $rate['monthlyRate'] }}
                                @endif
                            </td>
                            <td class="text-right">
                                @php
                                    $subtotal = 0;
                                    
                                    if(isset($rate['nights'])){
                                        $subtotal = $rate['nights'] * $rate['nightlyRate'];
                                    }

                                    if(isset($rate['weeks'])){
                                        $subtotal += $rate['weeks'] * $rate['weeklyRate'];
                                    }

                                    if(isset($rate['months'])){
                                        $subtotal += $rate['months'] * $rate['monthlyRate'];
                                    }

                                    $total += $subtotal;

                                @endphp
                                
                                ${{ number_format($subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><b>${{ number_format($total, 2) }}</b></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection
