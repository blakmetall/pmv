<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{ __('Start Date') }}</th>
                <th scope="col">{{ __('End Date') }}</th>
                <th scope="col">{{ __('Nightly') }}</th>
                <th scope="col">{{ __('Weekly') }}</th>
                <th scope="col">{{ __('Monthly') }}</th>
                <th scope="col">{{ __('Min Stay') }}</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col">&nbsp;</th>
            </tr>

        </thead>
        <tbody>

            @if(count($rows))
                @foreach($rows as $i => $row)
                    @php
                        $startDate = \Carbon\Carbon::parse(strtotime($row->start_date))->format('d/M/Y');
                        $endDate = \Carbon\Carbon::parse(strtotime($row->end_date))->format('d/M/Y');
                    @endphp
                    <tr>
                        <!-- index -->
                        <th scope="row">
                            {{ $i+1 }}
                        </th>
                        
                        <!-- id -->
                        <th scope="row">
                            {{ $row->id }}
                        </th>

                        <!-- start_date -->
                        <td>{{ $startDate }}</td>

                        <!-- end_date -->
                        <td>{{ $endDate }}</td>

                        <!-- nightly -->
                        <td>{{ priceFormat($row->nightly) }}</td>

                        <!-- weekly -->
                        <td>{{ priceFormat($row->weekly) }}</td>

                        <!-- monthly -->
                        <td>{{ priceFormat($row->monthly) }}</td>

                        <!-- min_stay -->
                        <td>{{ $row->min_stay }}</td>

                        <!-- property -->
                        <td>
                            @if ($row->property->hasTranslation())
                                <a href="{{ route('properties.show', [$row->property->id]) }}">
                                    {{ $row->property->translate()->name }}
                                </a>
                            @endif
                        </td>

                        <!-- actions -->
                        <td>
                            @include('components.table.actions', [
                                'params' => [$row->property->id, $row->id],
                                'showRoute' => 'property-rates.show',
                                'editRoute' => 'property-rates.edit',
                                'deleteRoute' => 'property-rates.destroy',
                                'skipEdit' => !can('edit', 'property-rates'),
                                'skipDelete' => !can('edit', 'property-rates'),
                            ])
                        </td>

                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
