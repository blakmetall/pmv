@extends('layouts.horizontal-master')

@section('main-content')

<!-- heading -->
<div class="container app-container">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md col-8">

                    <!-- title layout heading goes here -->
                    @include('partials.page-heading', [
                    'title' => __('Transaction Bulk'),
                    'breadcrumbs' => []
                    ])

                </div>

                <div class="col-md col-4 text-lg-right">
                    <!-- action buttons goes here -->
                </div>
            </div>

            <div class="pb-2"></div>

            <div class="pl-1 app-font-1">
                <ul>
                    <li>
                        {{ __("Please verify all information is accurate before submitting the form, if after the submission you need to make changes you will have to do this on the Pending Audits page.") }}
                    </li>
                    <li>
                        {{ __("You can use the default settings to set all transactions to the same settings, you can later change individual transactions to a specific need.") }}
                    </li>
                    <li>
                        <span class="text-red h4 app-font-2">*</span>
                        {{ __("Marked fields are required, if you omit one of these fields the transaction will not be created for that property.") }}
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

@if($successfullTransactions)
    <div class="container app-container app-bulk-success mb-4">
        <div class="alert alert-success alert-dismissible fade show pt-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <h5 class="mb-3">{{ __('Transactions Added') }}<a href="#" class="btn-print btn-print-bulk" data-table="table-print-transactions" data-title="{{ __('Transactions') }}">
                <i class="nav-icon i-Billing"></i>
                {{ __('Print') }}
            </a></h5>


            <ul>
                @foreach($successfullTransactions as $transaction)
                    <li>
                        <div class="row">
                            <!-- property name -->
                            <div class="col-3">{{ $transaction->propertyManagement->property->translate()->name }}</div>
                            <div class="col-3">{{ $transaction->type->translate()->name }}</div>
                            <div class="col-2">{{ getOperationTypeById($transaction->operation_type) }}</div>
                            <div class="col-2">{{ priceFormat($transaction->amount) }}</div>
                            <div class="col-2">{{ $transaction->post_date }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div id="table-print-transactions" class="table-responsive" style="display:none;">
                <table class="table table-striped app-transaction-list" data-show-print="true">
                    <thead>
                        <tr>
                            <th scope="col" class="transaction-col-property">{{ __('Property') }}</th>

                            <th scope="col" class="transaction-col-transaction-name">{{ __('Transaction') }}</th>

                            <th scope="col" class="transaction-col-period">{{ __('Type') }}</th>

                            <th scope="col" class="transaction-col-period">{{ __('Period') }}</th>

                            <th scope="col" class="transaction-col-date">{{ __('Post Date') }}</th>

                            <th scope="col" class="transaction-col-date">{{ __('Amount') }}</th>

                            <th scope="col" class="transaction-col-credit">{{ __('Credit') }}</th>
                            <th scope="col" class="transaction-col-charge">{{ __('Charge') }}</th>
                        </tr>

                    </thead>
                    <tbody>

                        <?php
                            $creditCount = 0;
                            $chargeCount = 0;
                        ?>

                        @foreach($successfullTransactions as $transaction)

                            <?php
                                $increase = !! ($transaction->operation_type === config('constants.operation_types.credit'));

                                if($increase) {
                                    $creditCount += $transaction->amount;
                                }else {
                                    $chargeCount += $transaction->amount;
                                }
                            ?>

                            <tr>
                                <!-- property -->
                                <td>
                                    {{ $transaction->propertyManagement->property->translate()->name }}
                                </td>

                                <!-- transaction_type_id -->
                                <td>
                                    {{ $transaction->type->translate()->name }}
                                </td>

                                <!-- operation_type -->
                                <td>
                                    {{ getOperationTypeById($transaction->operation_type) }}
                                </td>

                                <!-- period -->
                                <td>
                                    <div class="app-td-date">
                                        {{ $transaction->period_start_date }}

                                        @if($transaction->period_end_date)
                                            -
                                        @endif

                                        {{ $transaction->period_end_date }}
                                    </div>
                                </td>

                                <!-- post_date -->
                                <td>
                                    {{ $transaction->post_date }}
                                </td>

                                <!-- amount -->
                                <td>
                                    {{ priceFormat($transaction->amount) }}
                                </td>

                                <!-- credit -->
                                <td>
                                    @if($transaction->operation_type === config('constants.operation_types.credit'))
                                        {{ priceFormat($transaction->amount) }}
                                    @else
                                        --
                                    @endif
                                </td>

                                <!-- charges -->
                                <td>
                                    @if($transaction->operation_type === config('constants.operation_types.charge'))
                                        {{ priceFormat($transaction->amount) }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <!-- table totals -->
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th class="text-primary">{{ priceFormat($creditCount) }}</th>
                            <th class="text-primary">{{ priceFormat($chargeCount) }}</th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<div class="container app-container">

    <div class="card">
        <div class="card-header">
            {{ __('Transaction Bulk') }}
        </div>

        <div class="card-body pt-4">
            <div class="table-responsive app-checkbox-actions">
                <form action="{{ route('property-management-transactions.store-bulk') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-striped app-bulk-table mb-4">
                        <thead>
                            <tr>
                                <th scope="col" class="bulk-count-col">#</th>
                                <th scope="col" class="bulk-property-col">
                                    <span class="text-red">*</span>
                                    {{ __('Property') }}
                                </th>
                                <th scope="col" class="bulk-transaction-col">
                                    <span class="text-red">*</span>
                                    {{ __('Transaction') }}
                                </th>
                                <th scope="col" class="bulk-transaction-type-col">
                                    <span class="text-red">*</span>
                                    {{ __('Type') }}
                                </th>
                                <th scope="col" class="bulk-from-col">{{ __('From') }}</th>
                                <th scope="col" class="bulk-to-col">{{ __('To') }}</th>
                                <th scope="col" class="bulk-post-date-col">
                                    <span class="text-red">*</span>
                                    {{ __('Post Date') }}
                                </th>
                                <th scope="col" class="bulk-amount-col">
                                    <span class="text-red">*</span>
                                    {{ __('Amount') }}
                                </th>
                                <th scope="col" class="bulk-notes-col">{{ __('Notes') }}</th>
                                <th scope="col" class="bulk-file-col">{{ __('File') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- emtpy row -->
                            <tr>
                                <td colspan="10">&nbsp;</td>
                            </tr>

                            <!-- default values row -->
                            <tr>
                                <td><b>--</b></td>

                                <!-- property -->
                                <td>
                                    <b>{{ __('Default values') }}</b>
                                </td>

                                <!-- transaction -->
                                <td>
                                    <select name="bulk[default][transaction_type_id]" class="form-control form-control-sm app-bulk-input" id="bulk-transaction-name">
                                        <option value="">{{ __('Select') }}</option>

                                        @foreach($transactionTypes as $index => $transactionType)
                                            <option value="{{ $transactionType->transaction_type_id }}">
                                                {{ $transactionType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <!-- type -->
                                <td>
                                    <select name="bulk[default][operation_type]" class="form-control form-control-sm app-bulk-input" id="bulk-transaction-type">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="{{ config('constants.operation_types.charge') }}">
                                            {{ __('Charge') }}
                                        </option>
                                        <option value="{{ config('constants.operation_types.credit') }}">
                                            {{ __('Credit') }}
                                        </option>
                                    </select>
                                </td>

                                <!-- from -->
                                <td>
                                    <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker" name="bulk[default][period_start_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360" id="bulk-transaction-from-date">
                                </td>

                                <!-- to -->
                                <td>
                                    <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker" name="bulk[default][period_end_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360" id="bulk-transaction-to-date">
                                </td>

                                <!-- post date -->
                                <td>
                                    <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker" name="bulk[default][post_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360" id="bulk-transaction-post-date">
                                </td>

                                <!-- amount -->
                                <td>
                                    <!--<input type="number" class="form-control form-control-sm app-bulk-input" name="bulk[default][amount]">-->
                                </td>

                                <!-- notes -->
                                <td>
                                    <!--<textarea rows="1" class="form-control form-control-sm app-bulk-input" name="bulk[default][description]"></textarea>-->
                                </td>

                                <!-- file -->
                                <td>--</td>
                            </tr>

                            <!-- emtpy row -->
                            <tr>
                                <td colspan="10">&nbsp;</td>
                            </tr>


                            <?php
                                $maxBulk = (count($properties) < 50) ? 50 : count($properties);
                                $loopCount = array_fill(0, $maxBulk, null);
                            ?>

                            @foreach($loopCount as $loopIndex=> $loop)
                                <tr>
                                    <td><b>{{ $loopIndex + 1 }}</b></td>

                                    <!-- property -->
                                    <td>
                                        <select name="bulk[{{ $loopIndex }}][property_management_id]" class="form-control form-control-sm app-bulk-input">
                                            <option value="">{{ __('Select') }}</option>

                                            @foreach($properties as $propertyIndex => $propertyTranslation)
                                                @php
                                                    $selected = $propertyIndex == $loopIndex ? ' selected' : '';
                                                    $activePM = $propertyTranslation->property->getActivePM();
                                                @endphp

                                                @if($activePM)
                                                    <option value="{{ $activePM->id }}" {{ $selected }}>
                                                        {{ $propertyTranslation->name }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </td>

                                    <!-- transaction -->
                                    <td>
                                        <select name="bulk[{{ $loopIndex }}][transaction_type_id]" class="form-control form-control-sm app-bulk-input bulk-transaction-name">
                                            <option value="">{{ __('Select') }}</option>

                                            @foreach($transactionTypes as $index => $transactionType)
                                                <option value="{{ $transactionType->transaction_type_id }}">
                                                    {{ $transactionType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <!-- type -->
                                    <td>
                                        <select name="bulk[{{ $loopIndex }}][operation_type]" class="form-control form-control-sm app-bulk-input bulk-transaction-type">
                                            <option value="">{{ __('Select') }}</option>

                                            <option value="{{ config('constants.operation_types.charge') }}">
                                                {{ __('Charge') }}
                                            </option>
                                            <option value="{{ config('constants.operation_types.credit') }}">
                                                {{ __('Credit') }}
                                            </option>
                                        </select>
                                    </td>

                                    <!-- from -->
                                    <td>
                                        <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker bulk-transaction-from-date" name="bulk[{{ $loopIndex }}][period_start_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360">
                                    </td>

                                    <!-- to -->
                                    <td>
                                        <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker bulk-transaction-to-date" name="bulk[{{ $loopIndex }}][period_end_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360">
                                    </td>

                                    <!-- post date -->
                                    <td>
                                        <input type="text" class="form-control form-control-sm app-bulk-input app-input-datepicker bulk-transaction-post-date" name="bulk[{{ $loopIndex }}][post_date]" data-format="yyyy-mm-dd" data-max-days-limit-from-now="360">
                                    </td>

                                    <!-- amount -->
                                    <td>
                                        <input type="text" class="form-control form-control-sm app-bulk-input" name="bulk[{{ $loopIndex }}][amount]">
                                    </td>

                                    <!-- notes -->
                                    <td>
                                        <textarea rows="1" class="form-control form-control-sm app-bulk-input" name="bulk[{{ $loopIndex }}][description]"></textarea>
                                    </td>

                                    <!-- file -->
                                    <td>
                                        <input type="file" class="app-bulk-input" name="bulk[{{ $loopIndex }}][transaction_file]">
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary mb-5 px-5 py-2 app-font-1">
                        {{ __('Send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
