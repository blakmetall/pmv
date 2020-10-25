<?php

    $skipAuditedTable = isset($skipAuditedTable) ? (bool) $skipAuditedTable : false;
    $useBalancePresentation = isset($useBalancePresentation) ? (bool) $useBalancePresentation : false;
    $usePendingAuditPresentation = isset($usePendingAuditPresentation) ? (bool) $usePendingAuditPresentation : false;
    $useGeneralSearchPresentation = isset($useGeneralSearchPresentation) ? (bool) $useGeneralSearchPresentation : false;

    $balanceCount = 0;
    if(isset($currentBalance)) {
        $balanceCount = $currentBalance['estimatedBalance'];
    }

    $tableClass = $usePendingAuditPresentation ? 'app-transaction-pending-audit-list' : 'app-transaction-list';
    if(isRole('owner')) {
        $tableClass = 'app-transaction-owner-list';
    }
    $pendingTableClass = $tableClass . '-pending';

    $hideBalance = $useGeneralSearchPresentation;
    $hideTotalsRow = $useGeneralSearchPresentation;

    $shouldShowBalanceColumn = !$usePendingAuditPresentation;
    $shouldShowBalanceColumn = $hideBalance ? false : $shouldShowBalanceColumn;

    $months = [
        1 => __('January'),
        2 => __('February'),
        3 => __('March'),
        4 => __('April'),
        5 => __('May'),
        6 => __('June'),
        7 => __('July'),
        8 => __('August'),
        9 => __('September'),
        10 => __('October'),
        11 => __('November'),
        12 => __('December'),
    ];
?>

<div class="mb-5"></div>

<?php
    $hasTransactions = false;
    foreach($rows as $index => $row) {
        if($row->auditedBy) {
            $hasTransactions = true;
            break;
        }
    }

    $urlParams = '?' . http_build_query($_GET);
?>

@if(!$skipAuditedTable)

    <!-- audited transactions -->
    <div class="card">
        <div class="card-header card-header-print">
            <div>
                {{ $label }}
            </div>
            @if($hasTransactions)
                <a href="#" class="btn-print" data-table="table-print-transactions" data-title="{{ __('Transactions') }}">
                    <i class="nav-icon i-Billing"></i>
                    {{ __('Print') }}
                </a>
            @endif
        </div>
        <div class="card-body pt-4">

            @if($hasTransactions)
                <div id="table-print-transactions" class="table-responsive">
                    <table class="table table-striped {{ $tableClass }}" data-show-print="true">
                        <thead>
                            @if($shouldShowBalanceColumn)
                                <tr>
                                    <?php $colspanMonth = !isRole('owner') ? 9 : 7; ?>
                                    <th colspan="{{ $colspanMonth }}">
                                        @if(isset($_GET['month']) && $_GET['year'])
                                            {{ $months[(int)$_GET['month']] }}
                                            -
                                            {{ $_GET['year'] }}
                                        @endif
                                    </th>

                                    <?php $colspanYear = !isRole('owner') ? 4 : 3; ?>
                                    <th colspan="{{ $colspanYear }}">
                                        {{ __('Previous Balance') }}: &nbsp;&nbsp;

                                        <?php
                                            $isUnderAverage = false;

                                            if(isset($rows[0]) && isset($rows[0]->propertyManagement)) {
                                                $isUnderAverage = $rows[0]->propertyManagement->average_month > $balanceCount;
                                            }

                                            $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                        ?>

                                        <span class="{{ $underAverageClass }}">
                                            {{ priceFormat($balanceCount) }}
                                        </span>
                                    </th>
                                </tr>
                            @endif

                            <tr>
                                <th scope="col" class="transaction-col-id">#</th>

                                @if(!isRole('owner'))
                                    <th scope="col">
                                        <div class="not-print transaction-col-checkbox">&nbsp;</div>
                                    </th>
                                @endif

                                <th scope="col" class="transaction-col-file">
                                    <div class="not-print" style="min-width: 100px;"></div>
                                </th>

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

                                @if(!isRole('owner'))
                                    <th scope="col" class="transaction-col-created">{{ __('Created') }}</th>
                                    <th scope="col" class="transaction-col-updated">{{ __('Updated') }}</th>
                                @else
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                @endif

                                @if(!isRole('owner'))
                                    <th scope="col" class="transaction-col-audited">{{ __('Audited') }}</th>
                                @endif

                            </tr>

                        </thead>
                        <tbody>

                            <?php
                                $creditCount = 0;
                                $chargeCount = 0;
                            ?>

                            @if(count($rows))
                                @foreach($rows as $row)

                                    <?php
                                        if (!$row->auditedBy) { continue; }

                                        $increase = !! ($row->operation_type === config('constants.operation_types.credit'));

                                        if($increase) {
                                            $creditCount += $row->amount;
                                            $balanceCount += $row->amount;
                                        }else {
                                            $chargeCount += $row->amount;
                                            $balanceCount -= $row->amount;
                                        }
                                    ?>

                                    <tr>
                                        <!-- id -->
                                        <th scope="row">
                                            {{ $row->id }}
                                        </th>

                                        <!-- checkbox -->
                                        @if(!isRole('owner'))
                                            <td>
                                                <div class="not-print">
                                                &nbsp;
                                                </div>
                                            </td>
                                        @endif

                                        <!-- edit and file -->
                                        <td>
                                            <div class="not-print">
                                                <a href="{{ route('property-management-transactions.email', [$row->propertyManagement->id, $row->id]) }}" class="mr-2">
                                                    <img src="/images/email.svg" alt="" style="width: 17px; position: relative; top: -2px;">
                                                </a>

                                                @if($row->file_url)
                                                    @include('components.table.file-modal', [
                                                        'fileName' => $row->file_original_name,
                                                        'filePath' => $row->file_path,
                                                        'fileUrl' => $row->file_url,
                                                        'fileSlug' => $row->file_slug,
                                                    ])
                                                @endif

                                                @if(!isRole('owner'))
                                                    @include('property-management-transactions.partials.modal-edit', ['pm' => $row->propertyManagement, 'transaction' => $row])

                                                    @if(!$usePendingAuditPresentation)
                                                        <a href="{{ route('property-management-transactions.destroy', [$row->propertyManagement->id, $row->id]) }}{{ $urlParams }}" class="text-danger app-icon-link app-confirm" style="position:relative; top: 3px;" data-label="{{ __('Confirm Deletion') }}">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>

                                        <!-- post_date -->
                                        <td>
                                            <div class="app-td-date">
                                                {{ $row->post_date }}
                                            </div>
                                        </td>

                                        <!-- property -->
                                        @if(!isRole('owner'))
                                            <td>
                                                @if($row->propertyManagement->property->hasTranslation())
                                                    <a href="{{ route('properties.show', [$row->propertyManagement->property->id]) }}">
                                                        {{ $row->propertyManagement->property->translate()->name }}
                                                    </a>
                                                @endif
                                            </td>
                                        @endif

                                        <!-- transaction_type_id -->
                                        <td>
                                            @if($row->type)
                                                {{ $row->type->translate()->name }}
                                            @endif

                                            @if($row->description)
                                                <p class="app-pm-description">{!! nl2br($row->description) !!}</p>
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
                                                <?php
                                                    $isUnderAverage = $row->propertyManagement->average_month > $balanceCount;
                                                    $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                                ?>

                                                <span class="{{ $underAverageClass }}">
                                                    {{ priceFormat($balanceCount) }}
                                                </span>
                                            </td>
                                        @endif

                                        <!-- created/updated cols -->
                                        @if(!isRole('owner'))
                                            @include('components.table.created-updated', [
                                            'created_at' => $row->created_at,
                                            'updated_at' => $row->updated_at,
                                            'trimTime' => true,
                                            'model' => $row,
                                            ])
                                        @else
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @endif

                                        <!-- audited cols -->
                                        @if(!isRole('owner'))
                                            @include('components.table.created-updated', [
                                            'audited_at' => $row->audit_date,
                                            'auditedBy' => $row->auditedBy,
                                            'trimTime' => true,
                                            ])
                                        @endif

                                    </tr>
                                @endforeach
                            @endif

                            <!-- table totals -->
                            @if(!$hideTotalsRow)
                                <tr>
                                    @if(isRole('owner'))
                                        <td colspan="5">&nbsp;</td>
                                    @else
                                        <td colspan="7">&nbsp;</td>
                                    @endif

                                    <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                                    <th class="text-primary">{{ priceFormat($chargeCount) }}</th>

                                    @if($shouldShowBalanceColumn)
                                        <th class="text-primary">
                                            @php
                                                $isUnderAverage = $row->propertyManagement->average_month > $balanceCount;
                                                $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                            @endphp

                                            <span class="{{ $underAverageClass }}">
                                                {{ priceFormat($balanceCount) }}
                                            </span>
                                        </th>
                                    @endif

                                    @if($useBalancePresentation)
                                        <td colspan="4">&nbsp;</td>
                                    @else
                                        <td colspan="3">&nbsp;</td>
                                    @endif
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            @else
                <div id="table-print-transactions" class="table-responsive">
                    <table class="table table-striped {{ $tableClass }}" data-show-print="true">
                        <thead>
                            @if($shouldShowBalanceColumn)
                                <tr>
                                    <?php $colspanMonth = !isRole('owner') ? 9 : 7; ?>
                                    <th colspan="{{ $colspanMonth }}">
                                        @if(isset($_GET['month']) && $_GET['year'])
                                            {{ $months[(int)$_GET['month']] }}
                                            -
                                            {{ $_GET['year'] }}
                                        @endif
                                    </th>

                                    <?php $colspanYear = !isRole('owner') ? 4 : 3; ?>
                                    <th colspan="{{ $colspanYear }}">
                                        {{ __('Previous Balance') }}: &nbsp;&nbsp;

                                        <?php
                                            $isUnderAverage = false;

                                            if(isset($pm)) {
                                                $isUnderAverage = $pm->average_month > $balanceCount;
                                            }

                                            $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                        ?>

                                        <span class="{{ $underAverageClass }}">
                                            {{ priceFormat($balanceCount) }}
                                        </span>
                                    </th>
                                </tr>
                            @endif
                        </thead>
                    </table>
                </div>
            @endif

        </div>
    </div>

    <div class="mb-5"></div>

@endif


<?php
    $hasPendingAudits = false;
    foreach($rows as $index => $row) {
        if(!$row->auditedBy) {
            $hasPendingAudits = true;
            break;
        }
    }
?>

@if(!isRole('owner'))

    <!-- pending transactions -->
    <div class="card">
        <div class="card-header card-header-print">
            <div>
                {{ __('Pending Transactions') }}
            </div>
            @if($hasPendingAudits)
                <a href="#" class="btn-print" data-table="table-print-pending" data-title="{{ __('Pending Transactions') }}">
                    <i class="nav-icon i-Billing"></i>
                    {{ __('Print') }}
                </a>
            @endif
        </div>
        <div class="card-body pt-4">
            @if($hasPendingAudits)
                <div id="table-print-pending" class="table-responsive app-checkbox-actions">
                    <table class="table table-striped {{ $pendingTableClass }}">
                        <thead>

                            <tr>
                                <th scope="col" class="transaction-col-id">#</th>
                                <th scope="col" class="transaction-col-checkbox">
                                    <div class="not-print form-group form-check">
                                        <input type="checkbox" class="form-check-input app-checkbox-actions-header">
                                    </div>
                                </th>
                                <th scope="col" class="transaction-col-file">
                                    <div style="min-width: 70px;"></div>
                                </th>
                                <th scope="col" class="transaction-col-date">
                                    {{ __('Date') }}

                                    @if($usePendingAuditPresentation)
                                        @php
                                            $_GET['orderBy'] = 'date';
                                            $_GET['orderDirection'] = 'down';
                                        @endphp

                                        <a href="{{ route('property-management-transactions.general', $_GET) }}" class="app-table-th-icon">
                                            <i class="i-Arrow-Down-2"></i>
                                        </a>

                                        @php
                                            $_GET['orderBy'] = 'date';
                                            $_GET['orderDirection'] = 'up';
                                        @endphp

                                        <a href="{{ route('property-management-transactions.general', $_GET) }}" class="app-table-th-icon">
                                            <i class="i-Arrow-Up-2"></i>
                                        </a>
                                    @endif
                                </th>
                                <th scope="col" class="transaction-col-property">
                                    {{ __('Property') }}

                                    @if($usePendingAuditPresentation)
                                        @php
                                            $_GET['orderBy'] = 'property';
                                            $_GET['orderDirection'] = 'down';
                                        @endphp

                                        <a href="{{ route('property-management-transactions.general', $_GET) }}" class="app-table-th-icon">
                                            <i class="i-Arrow-Down-2"></i>
                                        </a>

                                        @php
                                            $_GET['orderBy'] = 'property';
                                            $_GET['orderDirection'] = 'up';
                                        @endphp

                                        <a href="{{ route('property-management-transactions.general', $_GET) }}" class="app-table-th-icon">
                                            <i class="i-Arrow-Up-2"></i>
                                        </a>
                                    @endif
                                </th>

                                <th scope="col" class="transaction-col-transaction-name">{{ __('Transaction') }}</th>
                                <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>

                                @if($usePendingAuditPresentation)
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

                                @if(!$usePendingAuditPresentation)
                                    <th scope="col" class="transaction-col-audited">{{ __('Audited') }}</th>
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

                                    <?php
                                        if ($row->auditedBy) { continue; }

                                        $increase = !! ($row->operation_type === config('constants.operation_types.credit'));

                                        if($increase) {
                                            $balanceCount += $row->amount;
                                            $creditCount += $row->amount;
                                        }else {
                                            $balanceCount -= $row->amount;
                                            $chargeCount += $row->amount;
                                        }
                                    ?>

                                    <tr>
                                        <!-- id -->
                                        <th scope="row">
                                            {{ $row->id }}
                                        </th>

                                        <!-- checkbox -->
                                        <td>
                                            <div class="not-print form-group form-check">
                                                <input type="checkbox" class="form-check-input app-checkbox-actions-item" value="{{ $row->id }}">
                                            </div>
                                        </td>

                                        <!-- edit, file and delete -->
                                        <td>
                                            <div class="not-print">
                                                @include('components.table.file-modal', [
                                                    'fileName' => $row->file_original_name,
                                                    'filePath' => $row->file_path,
                                                    'fileUrl' => $row->file_url,
                                                    'fileSlug' => $row->file_slug,
                                                ])

                                                @if(!isRole('owner'))
                                                    @include('property-management-transactions.partials.modal-edit', ['pm' => $row->propertyManagement, 'transaction' => $row])

                                                    @if(!$usePendingAuditPresentation)
                                                        <a href="{{ route('property-management-transactions.destroy', [$row->propertyManagement->id, $row->id]) }}{{ $urlParams }}" class="text-danger app-icon-link app-confirm" style="position:relative; top: 3px;"  data-label="{{ __('Confirm Deletion') }}">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>

                                        <!-- post_date -->
                                        <td>
                                            <div class="app-td-date">
                                                {{ $row->post_date }}
                                            </div>
                                        </td>

                                        <!-- property -->
                                        <td>
                                            @if($row->propertyManagement && $row->propertyManagement->property && $row->propertyManagement->property->hasTranslation())
                                                <div class="d-flex">
                                                    <div class="pr-2">
                                                        <a href="{{ route('properties.show', [$row->propertyManagement->property->id]) }}">
                                                            {{ $row->propertyManagement->property->translate()->name }}
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('property-management-transactions', [$row->propertyManagement->id]) }}" class="text-primary">
                                                            <i class="nav-icon i-Receipt-3 font-weight-bold" style="font-size: 11px;"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- transaction_type_id -->
                                        <td>
                                            @if($row->type)
                                                {{ $row->type->translate()->name }}
                                            @endif

                                            @if($row->description)
                                                <p class="app-pm-description">{!! nl2br($row->description) !!}</p>
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

                                        <!-- amount, type and charges cols -->
                                        @if($usePendingAuditPresentation)
                                            <!-- amount -->
                                            <td>{{ priceFormat($row->amount) }}</td>

                                            <!-- type -->
                                            <td>{{ getOperationTypeById($row->operation_type) }}</td>

                                            @php
                                                $totalPendingAudits += $row->amount;
                                            @endphp
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
                                        @else
                                            --
                                        @endif
                                        <span class="not-print">
                                            <!-- created/updated cols -->
                                            @include('components.table.created-updated', [
                                                'created_at' => $row->created_at,
                                                'updated_at' => $row->updated_at,
                                                'trimTime' => true,
                                                'model' => $row,
                                            ])
                                        </span>

                                        <!-- audit col -->
                                        @if(!$usePendingAuditPresentation)
                                            <td>--</td>
                                        @endif

                                    </tr>
                                @endforeach

                            @endif

                            <!-- table totals -->
                            @if(!$hideTotalsRow)
                                @if($usePendingAuditPresentation)
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
                                            <th class="text-primary">
                                                @php
                                                    $isUnderAverage = $row->propertyManagement->average_month > $balanceCount;
                                                    $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                                                @endphp

                                                <span class="{{ $underAverageClass }}">
                                                    {{ priceFormat($balanceCount) }}
                                                </span>
                                            </th>
                                        @endif

                                        @if($useBalancePresentation)
                                            <td colspan="4">&nbsp;</td>
                                        @else
                                            <td colspan="3">&nbsp;</td>
                                        @endif
                                    </tr>
                                @endif
                            @endif

                        </tbody>
                    </table>

                    <!-- bulk bottom actions -->
                    <div class="not-print pt-2">
                        <a href="#" role="button" class="btn btn-secondary btn-sm mr-3 app-checkbox-actions-btn" data-confirm-label="{{ __('Confirm audit batch') }}" data-base-url="{{ route('property-management-transactions.audit-batch') }}">
                            {{ __('Audit selected') }}
                        </a>
                        <a href="#" role="button" class="btn btn-secondary btn-sm app-checkbox-actions-btn" data-confirm-label="{{ __('Confirm delete batch') }}" data-base-url="{{ route('property-management-transactions.delete-batch') }}">
                            {{ __('Delete selected') }}
                        </a>
                    </div>
                </div>
            @else
                {{ __('No transactions found.') }}
            @endif
        </div>
    </div>
@endif
