@php

$currentYear = date('Y', strtotime('now'));
$currentMonth = date('m', strtotime('now'));

$textSearched = isset($_GET['s']) ? $_GET['s'] : '';

$searchedProperty = isset($_GET['property']) ? $_GET['property'] : '';
$searchedTransaction = isset($_GET['transaction_type']) ? $_GET['transaction_type'] : '';
$searchedOffice = isset($_GET['office']) ? $_GET['office'] : '';

$filterTransactionTypes = false;
if ($transationTypesOptionsIds !== false) {
    $filterTransactionTypes = true;
}

@endphp

<div class="container app-container mb-5">

    <div class="card">
        <div class="card-body">

            <form action="" action="get">
                <input type="hidden" name="filterByPendingAudits"
                    value="{{ isset($_GET['filterByPendingAudits']) ? '1' : '0' }}">
                <input type="hidden" name="orderBy" value="{{ isset($_GET['orderBy']) ? $_GET['orderBy'] : '' }}">
                <input type="hidden" name="orderDirection"
                    value="{{ isset($_GET['orderDirection']) ? $_GET['orderDirection'] : '' }}">


                <div class="row pt-3">
                    <div class="col-sm-6 col-md-2">
                        <input class="form-control" placeholder="{{ __('Search...') }}" type="text" name="s"
                            value="{{ $textSearched }}" />
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="property" class="form-control">
                            <option value="">-- {{ __('Property') }}</option>

                            @if ($properties)
                                @foreach ($properties as $translatedProperty)
                                    @php
                                        $selected = $searchedProperty == $translatedProperty->property_id ? 'selected' : '';
                                    @endphp

                                    <option value="{{ $translatedProperty->property_id }}" {{ $selected }}>
                                        {{ $translatedProperty->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="transaction_type" class="form-control">
                            <option value="">-- {{ __('Transaction Type') }}</option>

                            @if ($transactionTypes)
                                @foreach ($transactionTypes as $translatedTransactionType)
                                    @php
                                        $selected = $searchedTransaction == $translatedTransactionType->transaction_type_id ? 'selected' : '';
                                    @endphp

                                    @php
                                        // show only transaction types options according to found transactions
                                        if ($filterTransactionTypes) {
                                            if (!in_array($translatedTransactionType->transaction_type_id, $transationTypesOptionsIds)) {
                                                continue;
                                            }
                                        }
                                    @endphp

                                    <option value="{{ $translatedTransactionType->transaction_type_id }}"
                                        {{ $selected }}>
                                        {{ $translatedTransactionType->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="office" class="form-control">
                            <option value="">-- {{ __('Office') }}</option>

                            @if ($offices)
                                @foreach ($offices as $office)
                                    @php
                                        $selected = $searchedOffice == $office->id ? 'selected' : '';
                                    @endphp

                                    <option value="{{ $office->id }}" {{ $selected }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="withImage" class="form-control">
                            <option value="">-- {{ __('Image Filter') }}</option>

                            @php
                                $withImageOptions = [
                                    1 => __('With Image'),
                                    2 => __('Without Image'),
                                ];
                            @endphp
                            @foreach ($withImageOptions as $value => $label)
                                @php
                                    $selected = isset($_GET['withImage']) && $_GET['withImage'] == $value ? 'selected' : '';
                                @endphp

                                <option value="{{ $value }}" {{ $selected }}>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2 app-search-buttons">
                        <button class="btn btn-dark btn-icon mr-2" type="submit">
                            <span class="ul-btn__icon">
                                <i class="i-Magnifi-Glass1"></i>
                            </span>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
