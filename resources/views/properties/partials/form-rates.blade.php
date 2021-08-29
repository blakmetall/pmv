@php
    $label = isset($label) ? $label : '';
    $rates = $row->rates->sortBy('end_date');
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
                            @php
                                $startDate = \Carbon\Carbon::parse(strtotime($rate->start_date))->format('d/M/Y');
                                $endDate = \Carbon\Carbon::parse(strtotime($rate->end_date))->format('d/M/Y');
                            @endphp
                            <tr>
                                <!-- start_date -->
                                <td>{{ $startDate }}</td>

                                <!-- end_date -->
                                <td>{{ $endDate }}</td>

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
