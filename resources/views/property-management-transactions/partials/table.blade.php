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
                        <th scope="col">{{ __('Transaction') }}</th>
                        <th scope="col">{{ __('Period Start Date') }}</th>
                        <th scope="col">{{ __('Period End Date') }}</th>
                        <th scope="col">{{ __('Post Date') }}</th>
                        <th scope="col">{{ __('Amount') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Audited By') }}</th>
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

                                <!-- transaction_type_id -->
                                <td>
                                    @if ($row->transaction_type_id)
                                        {{ $row->type->translate()->name }}
                                    @endif
                                </td>

                                <!-- period_start_date -->
                                <td>{{ $row->period_start_date }}</td>

                                <!-- period_end_date -->
                                <td>{{ $row->period_end_date }}</td>

                                <!-- post_date -->
                                <td>{{ $row->post_date }}</td>

                                <!-- amount -->
                                <td>{{ priceFormat($row->amount) }}</td>

                                <!-- description -->
                                <td>{{ $row->description }}</td>

                                <!-- property -->
                                <td>
                                    @if ($row->propertyManagement->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->propertyManagement->property->id]) }}">
                                            {{ $row->propertyManagement->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- audit_user_id -->
                                <td>
                                    @if ($row->auditedBy)
                                        {{ $row->auditedBy->profile->full_name }}
                                    @endif
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->propertyManagement->id, $row->id],
                                        'showRoute' => 'property-management-transactions.show',
                                        'editRoute' => 'property-management-transactions.edit',
                                        'deleteRoute' => 'property-management-transactions.destroy',
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
