@php
    $label = isset($label) ? $label : '';
    $rates = $row->rates;
@endphp
@if(count($rates))
<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Start Date') }}</th>
                        <th scope="col">{{ __('End Date') }}</th>
                        <th scope="col">{{ __('Nightly') }}</th>
                        <th scope="col">{{ __('Weekly') }}</th>
                        <th scope="col">{{ __('Monthly') }}</th>
                        <th scope="col">{{ __('Min Stay') }}</th>
                    </tr>

                </thead>
                <tbody>

                        @foreach($rates as $rate)
                            <tr>
                                <!-- start_date -->
                                <td>{{ $rate->start_date }}</td>

                                <!-- end_date -->
                                <td>{{ $rate->end_date }}</td>

                                <!-- nightly -->
                                <td>{{ priceFormat($rate->nightly) }}</td>

                                <!-- weekly -->
                                <td>{{ priceFormat($rate->weekly) }}</td>

                                <!-- monthly -->
                                <td>{{ priceFormat($rate->monthly) }}</td>

                                <!-- min_stay -->
                                <td>{{ $rate->min_stay }}</td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
@endif
