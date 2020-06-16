@php

    $skipAuditedTable = isset($skipAuditedTable) ? (bool) $skipAuditedTable : false;

    $balanceCount = 0;
    $shouldShowBalanceColumn = isset($showBalanceColumn) ? $showBalanceColumn : false;
    if($shouldShowBalanceColumn && isset($currentBalance)) {
        $balanceCount = $currentBalance['balance'];
    }

@endphp

<div class="mb-5"></div>

@if (!$skipAuditedTable)

    <!-- audited transactions -->
    <div class="card">
        <div class="card-header">{{ $label }}</div>
        <div class="card-body pt-5">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th scope="col" class="transaction-col-id">#</th>
                            <th scope="col" class="transaction-col-date">{{ __('Date') }}</th>
                            <th scope="col" class="transaction-col-property">{{ __('Property') }}</th>
                            <th scope="col" class="transaction-col-name">{{ __('Transaction') }}</th>
                            <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>
                            <th scope="col" class="transaction-col-credit">{{ __('Credit') }}</th>
                            <th scope="col" class="transaction-col-charge">{{ __('Charge') }}</th>

                            @if($shouldShowBalanceColumn)
                                <th scope="col" class="transaction-col-balance">{{ __('Balance') }}</th>
                            @endif

                            @if(!isRole('owner'))
                                <th scope="col" class="transaction-col-audit">{{ __('Audited By') }}</th>
                            @endif

                            <th scope="col" class="transaction-col-file">{{ __('File') }}</th>
                            <th scope="col" class="transaction-col-actions">&nbsp;</th>
                        </tr>

                    </thead>
                    <tbody>

                        @php 
                            $creditCount = 0;
                            $chargeCount = 0;
                        @endphp

                        @if(count($rows))
                            @foreach($rows as $row)

                                @php
                                    if (!$row->auditedBy) { continue; }

                                    $increase = !! ($row->operation_type === config('constants.operation_types.credit'));
                                    if($increase) {
                                        $creditCount += $row->amount;
                                        $balanceCount += $row->amount;
                                    }else {
                                        $chargeCount += $row->amount;
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

                                    <!-- balance -->
                                    @if($shouldShowBalanceColumn)
                                        <td>
                                            @php 
                                                $isUnderAverage = $row->propertyManagement->average_month > $balanceCount; 
                                                $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                            @endphp

                                            <span class="{{ $underAverageClass }}">
                                                {{ priceFormat($balanceCount) }}
                                            </span>
                                        </td>
                                    @endif

                                    @if(!isRole('owner'))
                                        <!-- audit_user_id -->
                                        <td>
                                            @if ($row->auditedBy)
                                                <a href="{{ route('users.show', [$row->auditedBy->profile->user->id]) }}">
                                                    {{ $row->auditedBy->profile->full_name }}
                                                </a>
                                            @endif
                                        </td>
                                    @endif

                                    <!-- file -->
                                    <td>
                                        <div class="app-table-file-limit-width">
                                            @include('components.file-card', [
                                                'imgSize' => 'small-ls',
                                                'url' => $row->file_url,
                                                'extension' => $row->file_extension,
                                                'name' => $row->file_original_name,
                                            ])
                                        </div>
                                    </td>

                                    <!-- actions -->
                                    <td>
                                        @include('components.table.actions', [
                                            'params' => [$row->propertyManagement->id, $row->id],
                                            'showRoute' => 'property-management-transactions.show',
                                            'editRoute' => 'property-management-transactions.edit',
                                            'deleteRoute' => 'property-management-transactions.destroy',
                                            'skipEdit' => isRole('owner'),
                                            'skipDelete' => true,
                                        ])
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                        <!-- table totals -->
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                            <th class="text-primary">{{ priceFormat($chargeCount) }}</th>

                            @if($shouldShowBalanceColumn)
                                <th class="text-primary">{{ priceFormat($balanceCount) }}</th>
                            @endif

                            <td colspan="3">&nbsp;</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="mb-5"></div>

@endif

<!-- pending transactions -->
<div class="card">
    <div class="card-header">{{ __('Pending Transactions') }}</div>
    <div class="card-body pt-5">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col" class="transaction-col-id">#</th>
                        <th scope="col" class="transaction-col-date">{{ __('Date') }}</th>
                        <th scope="col" class="transaction-col-property">{{ __('Property') }}</th>
                        <th scope="col" class="transaction-col-name">{{ __('Transaction') }}</th>
                        <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>
                        <th scope="col" class="transaction-col-credit">{{ __('Credit') }}</th>
                        <th scope="col" class="transaction-col-charge">{{ __('Charge') }}</th>

                        @if($shouldShowBalanceColumn)
                            <th scope="col" class="transaction-col-balance">{{ __('Balance') }}</th>
                        @endif

                        <th scope="col" class="transaction-col-audit">{{ __('Audited By') }}</th>
                        <th scope="col" class="transaction-col-file">{{ __('File') }}</th>
                        <th scope="col" class="transaction-col-actions">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @php 
                        $creditCount = 0;
                        $chargeCount = 0;
                    @endphp

                    @if(count($rows))

                        @foreach($rows as $row)

                            @php
                                if ($row->auditedBy) { continue; }

                                $increase = !! ($row->operation_type === config('constants.operation_types.credit'));
                                if($increase) {
                                    $balanceCount += $row->amount;
                                    $creditCount += $row->amount;
                                }else {
                                    $balanceCount -= $row->amount;
                                    $chargeCount += $row->amount;
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

                                <!-- balance -->
                                @if($shouldShowBalanceColumn)
                                    <td>
                                        @php 
                                            $isUnderAverage = $row->propertyManagement->average_month > $balanceCount; 
                                            $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                        @endphp

                                        <span class="{{ $underAverageClass }}">
                                            {{ priceFormat($balanceCount) }}
                                        </span>
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

                                <!-- file -->
                                <td>
                                    <div class="app-table-file-limit-width">
                                        @include('components.file-card', [
                                            'imgSize' => 'small-ls',
                                            'url' => $row->file_url,
                                            'extension' => $row->file_extension,
                                            'name' => $row->file_original_name,
                                        ])
                                    </div>
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->propertyManagement->id, $row->id],
                                        'showRoute' => 'property-management-transactions.show',
                                        'editRoute' => 'property-management-transactions.edit',
                                        'deleteRoute' => 'property-management-transactions.destroy',
                                        'skipEdit' => isRole('owner'),
                                        'skipDelete' => isRole('owner'),
                                    ])
                                </td>

                            </tr>
                        @endforeach

                    @endif

                    <!-- table totals -->
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                        <th class="text-primary">{{ priceFormat($chargeCount) }}</th>

                        @if($shouldShowBalanceColumn)
                            <th class="text-primary">{{ priceFormat($balanceCount) }}</th>
                        @endif

                        <td colspan="3">&nbsp;</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
