@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('property-rates.partials.form-fields', ['row' => $row])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'property-rates.edit',
    'cancel_route' => 'property-rates',
    'delete_route' => 'property-rates.destroy',
    'routeParams' => [$property->id],
    'skipEdit' => isRole('owner'),
    'skipDelete' => isRole('owner'),
])

<div id="property-rates-info" style="margin-top: 50px">
    <h4 class="section-title" style="margin-bottom: 20px">{{ __('Rates') }}</h4>
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
            @foreach ($property->rates as $i => $rate)
                @php
                    $startDate = \Carbon\Carbon::parse(strtotime($rate->start_date))->format('d/M/Y');
                    $endDate = \Carbon\Carbon::parse(strtotime($rate->end_date))->format('d/M/Y');
                @endphp
                <tr class="{{ $i > 4 ? 'toggle-table-rates' : '' }}">
                    <td>{{ $startDate }} to {{ $endDate }}</td>
                    <td>{{ priceFormat($rate->nightly) }}</td>
                    <td>{{ priceFormat($rate->weekly) }}</td>
                    <td>{{ priceFormat($rate->monthly) }}</td>
                    <td>{{ $rate->min_stay }} {{ __('Nights') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>