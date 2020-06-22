@php

    $skipAuditedTable = isset($skipAuditedTable) ? (bool) $skipAuditedTable : false;
    $useBalancePresentation = isset($useBalancePresentation) ? (bool) $useBalancePresentation : false;
    $usePendingAuditPresentation = isset($usePendingAuditPresentation) ? (bool) $usePendingAuditPresentation : false;

    $shouldShowBalanceColumn = !$usePendingAuditPresentation;

    $balanceCount = 0;
    if($usePendingAuditPresentation && isset($currentBalance)) {
        $balanceCount = $currentBalance['balance'];
    }

    $tableClass = $usePendingAuditPresentation ? 'app-transaction-pending-audit-list' : 'app-transaction-list';
    if(isRole('owner')) {
        $tableClass = 'app-transaction-owner-list';
    }
    $pendingTableClass = $tableClass . '-pending';

@endphp

<div class="mb-5"></div>

@if (!$skipAuditedTable)

    <!-- audited transactions -->
    <div class="card">
        <div class="card-header">{{ $label }}</div>
        <div class="card-body pt-5">

            <div class="table-responsive">
                <table class="table table-striped {{ $tableClass }}">
                    <thead>

                        <tr>
                            <th scope="col" class="transaction-col-id">#</th>
                            
                            @if(!isRole('owner'))
                                <th scope="col" class="transaction-col-checkbox">&nbsp;</th>
                            @endif

                            <th scope="col" class="transaction-col-file">&nbsp;</th>
                            <th scope="col" class="transaction-col-date">{{ __('Date') }}</th>

                            @if(!isRole('owner'))
                                <th scope="col" class="transaction-col-property">{{ __('Property') }}</th>
                            @endif

                            <th scope="col" class="transaction-col-transaction-name">{{ __('Transaction') }}</th>
                            <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>
                            <th scope="col" class="transaction-col-credit">{{ __('Credit') }}</th>
                            <th scope="col" class="transaction-col-charge">{{ __('Charge') }}</th>

                            @if($shouldShowBalanceColumn)
                                <th scope="col" class="transaction-col-balance">{{ __('Balance') }}</th>
                            @endif

                            <th scope="col" class="transaction-col-created">{{ __('Created') }}</th>
                            <th scope="col" class="transaction-col-updated">{{ __('Updated') }}</th>

                            @if(!isRole('owner'))
                                <th scope="col" class="transaction-col-audited">{{ __('Audited') }}</th>
                                <th scope="col" class="transaction-col-actions">&nbsp;</th>
                            @endif

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

                                    @if(!isRole('owner'))
                                        <!-- checkbox -->
                                        <td>&nbsp;</td>
                                    @endif

                                    <!-- file -->
                                    <td>
                                        @include('components.table.file-modal', [
                                            'fileName' => $row->file_original_name,
                                            'filePath' => $row->file_path,
                                            'fileUrl' => $row->file_url,
                                            'fileSlug' => $row->file_slug,
                                        ])
                                    </td>

                                    <!-- post_date -->
                                    <td>
                                        <div class="app-td-date">
                                            {{ $row->post_date }}
                                        </div>
                                    </td>

                                    @if(!isRole('owner'))
                                        <!-- property -->
                                        <td>
                                            @if ($row->propertyManagement->property->hasTranslation())
                                                <a href="{{ route('properties.show', [$row->propertyManagement->property->id]) }}">
                                                    {{ $row->propertyManagement->property->translate()->name }}
                                                </a>
                                            @endif
                                        </td>
                                    @endif

                                    <!-- transaction_type_id -->
                                    <td>
                                        @if ($row->type)
                                            {{ $row->type->translate()->name }}
                                        @endif

                                        @if($row->description)
                                            <p class="app-pm-description">{{ $row->description }}</p>
                                        @endif
                                    </td>

                                    <!-- period -->
                                    <td>
                                        <div class="app-td-date">
                                            {{ $row->period_start_date }} 
                                            
                                            @if($row->period_end_date)
                                                -
                                            @endif
                                            
                                            {{ $row->period_end_date }}
                                        </div>
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
                                    
                                    <!-- created/updated cols -->
                                    @include('components.table.created-updated', [
                                        'created_at' => $row->created_at,
                                        'updated_at' => $row->updated_at,
                                        'trimTime' => true,
                                    ])

                                    @if(!isRole('owner'))
                                        <!-- audited cols -->
                                        @include('components.table.created-updated', [
                                            'audited_at' => $row->audit_date,
                                            'auditedBy' => $row->auditedBy,
                                            'trimTime' => true,
                                        ])

                                        <!-- actions -->
                                        <td>
                                            @include('components.table.actions', [
                                                'params' => [$row->propertyManagement->id, $row->id],
                                                'showRoute' => 'property-management-transactions.show',
                                                'editRoute' => 'property-management-transactions.edit',
                                                'deleteRoute' => 'property-management-transactions.destroy',
                                                'skipDelete' => true,
                                            ])
                                        </td>
                                    @endif


                                </tr>
                            @endforeach
                        @endif

                        <!-- table totals -->
                        <tr>
                            @if(isRole('owner'))
                                <td colspan="5">&nbsp;</td>
                            @else
                                <td colspan="7">&nbsp;</td>
                            @endif
                            

                            <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                            <th class="text-primary">{{ priceFormat($chargeCount) }}</th>

                            @if ($shouldShowBalanceColumn)
                                <th class="text-primary">{{ priceFormat($balanceCount) }}</th>
                            @endif

                            @if ($useBalancePresentation)
                                <td colspan="4">&nbsp;</td> 
                            @else
                                <td colspan="3">&nbsp;</td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="mb-5"></div>

@endif



@if(!isRole('owner'))

    <!-- pending transactions -->
    <div class="card">
        <div class="card-header">{{ __('Pending Transactions') }}</div>
        <div class="card-body pt-5">

            <div class="table-responsive">
                <table class="table table-striped {{ $pendingTableClass }}">
                    <thead>

                        <tr>
                            <th scope="col" class="transaction-col-id">#</th>
                            <th scope="col" class="transaction-col-checkbox">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                </div>
                            </th>
                            <th scope="col" class="transaction-col-file">&nbsp;</th>
                            <th scope="col" class="transaction-col-date">{{ __('Date') }}</th>
                            <th scope="col" class="transaction-col-property">{{ __('Property') }}</th>
                            <th scope="col" class="transaction-col-transaction-name">{{ __('Transaction') }}</th>
                            <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>

                            @if ($usePendingAuditPresentation)
                                <th scope="col" class="transaction-col-amount">{{ __('Amount') }}</th>
                                <th scope="col" class="transaction-col-type">{{ __('Type') }}</th>
                            @else
                                <th scope="col" class="transaction-col-credit">{{ __('Credit') }}</th>
                                <th scope="col" class="transaction-col-charge">{{ __('Charge') }}</th>
                            @endif

                            @if($shouldShowBalanceColumn)
                                <th scope="col" class="transaction-col-balance">{{ __('Balance') }}</th>
                            @endif

                            <th scope="col" class="transaction-col-created">{{ __('Created') }}</th>
                            <th scope="col" class="transaction-col-updated">{{ __('Updated') }}</th>

                            @if (!$usePendingAuditPresentation)
                                <th scope="col" class="transaction-col-audited">{{ __('Audited') }}</th>
                                <th scope="col" class="transaction-col-actions">&nbsp;</th>
                            @endif
                            
                        </tr>

                    </thead>
                    <tbody>

                        @php 
                            $creditCount = 0;
                            $chargeCount = 0;
                            $totalPendingAudits = 0;
                        @endphp

                        @if(count($rows))

                            @foreach($rows as $index => $row)

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

                                    <td>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        </div>
                                    </td>

                                    <!-- file -->
                                    <td>
                                        @include('components.table.file-modal', [
                                            'fileName' => $row->file_original_name,
                                            'filePath' => $row->file_path,
                                            'fileUrl' => $row->file_url,
                                            'fileSlug' => $row->file_slug,
                                        ])
                                    </td>

                                    <!-- post_date -->
                                    <td>
                                        <div class="app-td-date">
                                            {{ $row->post_date }}
                                        </div>
                                    </td>

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

                                        @if($row->description)
                                            <p class="app-pm-description">{{ $row->description }}</p>
                                        @endif
                                    </td>

                                    <!-- period -->
                                    <td>
                                        <div class="app-td-date">
                                            {{ $row->period_start_date }}

                                            @if($row->period_end_date)
                                                -
                                            @endif
                                            
                                            {{ $row->period_end_date }}
                                        </div>
                                    </td>

                                    @if ($usePendingAuditPresentation)
                                        <!-- amount -->
                                        <td>{{ priceFormat($row->amount) }}</td>

                                        <!-- type -->
                                        <td>{{ getOperationTypeById($row->operation_type) }}</td>

                                        @php $totalPendingAudits += $row->amount; @endphp
                                    @else
                                        
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

                                    @endif
                                    

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

                                    <!-- created/updated cols -->
                                    @include('components.table.created-updated', [
                                        'created_at' => $row->created_at,
                                        'updated_at' => $row->updated_at,
                                        'trimTime' => true,
                                    ])

                                    @if (!$usePendingAuditPresentation)
                                        <!-- audit col -->
                                        <td>--</td>

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
                                    @endif

                                </tr>
                            @endforeach

                        @endif

                        <!-- table totals -->
                        @if ($usePendingAuditPresentation)
                            <tr>
                                <td colspan="6">&nbsp;</td>
                                <td class="text-right">Total:</td>
                                <th class="text-primary">{{ priceFormat($totalPendingAudits) }}</th>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7">&nbsp;</td>
                                <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                                <th class="text-primary">{{ priceFormat($chargeCount) }}</th>

                                @if($shouldShowBalanceColumn)
                                    <th class="text-primary">{{ priceFormat($balanceCount) }}</th>
                                @endif
                                
                                @if ($useBalancePresentation)
                                    <td colspan="4">&nbsp;</td>
                                @else
                                    <td colspan="3">&nbsp;</td>
                                @endif
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endif
