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

    @if(isset($propertyRate['totalDays']))
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
                        <td>${{ number_format($propertyRate['nightlyAvgRate'], 2) }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('Nightly Applied Rate') }}</th>
                        <td>${{ number_format($propertyRate['nightlyAppliedRate'], 2) }}</td>
                    </tr>

                    {{-- <tr>
                        <th>{{ __('Has valid rate') }}</th>
                        <td>{{ $propertyRate['hasValidRate'] ? __('Yes') : __('No') }}</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    @endif

    <h4>{{ __('Applied Rates') }}</h4>

    {{-- <div>
        <table class="table">
            <thead>
                <th>#</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Discount') }}</th>
            </thead>

            <tbody>
                @if(isset($propertyRate['prices']) && count($propertyRate['prices']))
                    @php 
                        $total = 0;
                        $count = 0;
                    @endphp

                    @foreach($propertyRate['prices'] as $date => $nightlyRate)
                        @php $total += $nightlyRate['nightly'] @endphp
                        @php $count++ @endphp

                        <tr>
                            <th>{{ $count }}</th>
                            <td>{{ $date }}</td>
                            <td>
                                ${{ number_format($nightlyRate['nightly'], 2) }}
                            </td>
                            <td>
                                ${{ number_format($nightlyRate['savings'], 2) }}
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>${{ number_format($total, 2) }}</b></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div> --}}
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
                @if(isset($propertyRate['ranges']) && count($propertyRate['ranges']))
                    @php $total = 0; @endphp
                    

                    @foreach($propertyRate['ranges'] as $rateId => $rate)
                        <tr>
                            <td><b>#{{ $rateId }}</b></td>
                            <td>
                                @if(isset($rate['daysQty']) && $rate['daysQty'] > 0)
                                    {{ $rate['daysQty'] }} * {{ $rate['daysRate'] }}
                                @endif
                            </td>
                            <td>
                                @if(isset($rate['weeksQty']) && $rate['weeksQty'] > 0)
                                    {{ $rate['weeksQty'] }} * {{ $rate['weeksRate'] }}
                                @endif
                            </td>
                            <td>    
                                @if(isset($rate['monthsQty']) && $rate['monthsQty'] > 0)
                                    {{ $rate['monthsQty'] }} * {{ $rate['monthsRate'] }}
                                @endif
                            </td>
                            <td class="text-right">
                                @php
                                    $subtotal = 0;
                                    
                                    if(isset($rate['daysQty']) && $rate['daysQty'] > 0){
                                        $subtotal = $rate['daysQty'] * $rate['daysRate'];
                                    }

                                    if(isset($rate['weeksQty']) && $rate['weeksQty'] > 0){
                                        $subtotal += $rate['weeksQty'] * $rate['weeksRate'];
                                    }

                                    if(isset($rate['monthsQty']) && $rate['monthsQty'] > 0){
                                        $subtotal += $rate['monthsQty'] * $rate['monthsRate'];
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
