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
                        <th scope="col">{{ __('Date') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Transaction') }}</th>
                        <th scope="col">{{ __('Period') }}</th>
                        <th scope="col">{{ __('Credit') }}</th>
                        <th scope="col">{{ __('Charge') }}</th>
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

                                <!-- post_date -->
                                <td>{{ $row->post_date }}</td>

                                <!-- property -->
                                <td>
                                    @if ($row->propertyManagement->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->propertyManagement->property->id]) }}">
                                            {{ $row->propertyManagement->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- transaction_type_id -->
                                <td>
                                    @if ($row->type)
                                        {{ $row->type->translate()->name }}
                                    @endif

                                    <p class="app-pm-description">{{ $row->description }}</p>
                                </td>

                                <!-- period -->
                                <td>
                                    {{ $row->period_start_date }} 
                                    
                                    @if($row->period_end_date)
                                        -
                                    @endif
                                    
                                    {{ $row->period_end_date }}
                                </td>

                                <!-- credit -->
                                <td>
                                     @if($row->operation_type === config('constants.operation_types.credit'))
                                        {{ priceFormat($row->amount) }}
                                    @else
                                        --
                                    @endif
                                </td>

                                <!-- charges -->
                                <td>
                                    @if($row->operation_type === config('constants.operation_types.charge'))
                                        {{ priceFormat($row->amount) }}
                                    @else
                                        --
                                    @endif
                                </td>

                                <!-- audit_user_id -->
                                <td>
                                    @if ($row->auditedBy)
                                        <a href="{{ route('users.show', [$row->auditedBy->profile->user->id]) }}">
                                            {{ $row->auditedBy->profile->full_name }}
                                        </a>
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
