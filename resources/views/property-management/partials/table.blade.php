<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Start Date') }}</th>
                        <th scope="col">{{ __('End Date') }}</th>
                        <th scope="col">{{ __('Fee') }}</th>
                        <th scope="col">{{ __('Finished') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- start_date -->
                                <td>{{ $row->start_date }}</td>

                                <!-- end_date -->
                                <td>{{ $row->end_date }}</td>

                                <!-- nightly -->
                                <td>{{ priceFormat($row->fee) }}</td>

                                <!-- is_finished -->
                                <td>{!! getStatusIcon($row->is_finished) !!}</td>

                                <!-- property -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('property-management-transactions', $row->id) }}" 
                                        class="text-primary mr-2">
                                        <i class="nav-icon i-Receipt-3 font-weight-bold"></i>
                                    </a>
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id, $row->id],
                                        'showRoute' => 'property-management.show',
                                        'editRoute' => 'property-management.edit',
                                        'deleteRoute' => 'property-management.destroy',
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

    </div>
</div>
