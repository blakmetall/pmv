@php

    $balanceCount = 0;
    $shouldShowBalanceColumn = isset($showBalanceColumn) ? $showBalanceColumn : false;
    if($shouldShowBalanceColumn && isset($currentBalance)) {
        $balanceCount = $currentBalance['balance'];
    }

@endphp

<div class="mb-5"></div>

<!-- audited transactions -->
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

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

                        @if($shouldShowBalanceColumn)
                            <th scope="col">{{ __('Balance') }}</th>
                        @endif

                        <th scope="col">{{ __('Audited By') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)

                            @php
                                if (!$row->auditedBy) { continue; }

                                $increase = !! ($row->operation_type === config('constants.operation_types.credit'));
                                if($increase) {
                                    $balanceCount += $row->amount;
                                }else {
                                    $balanceCount -= $row->amount;
                                }
                            @endphp

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

                                @if($shouldShowBalanceColumn)
                                    <!-- balance -->
                                    <td>
                                        {{ priceFormat($balanceCount) }}
                                    </td>
                                @endif

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

    </div>
</div>

<div class="mb-5"></div>

<!-- pending transactions -->
<div class="card">
    <div class="card-header">{{ __('Pending Transactions') }}</div>
    <div class="card-body pt-5">

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

                        @if($shouldShowBalanceColumn)
                            <th scope="col">{{ __('Balance') }}</th>
                        @endif

                        <th scope="col">{{ __('Audited By') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)

                            @php
                                if ($row->auditedBy) { continue; }

                                $increase = !! ($row->operation_type === config('constants.operation_types.credit'));
                                if($increase) {
                                    $balanceCount += $row->amount;
                                }else {
                                    $balanceCount -= $row->amount;
                                }
                            @endphp

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

                                @if($shouldShowBalanceColumn)
                                    <!-- balance -->
                                    <td>
                                        {{ priceFormat($balanceCount) }}
                                    </td>
                                @endif

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

    </div>
</div>
