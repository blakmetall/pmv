@php

    $currentYear = date('Y', strtotime('now'));
    $currentMonth = date('m', strtotime('now'));

    $textSearched = isset($_GET['s']) ? $_GET['s'] : '';

    $searchedProperty = isset($_GET['property']) ? $_GET['property'] : '';
    $searchedTransaction = isset($_GET['transaction_type']) ? $_GET['transaction_type'] : '';
    $searchedCity = isset($_GET['city']) ? $_GET['city'] : '';

@endphp

<div class="container app-container mb-5">

    <div class="card">
        <div class="card-body">

            <form action="" action="get">
                <div class="row pt-3">
                    <div class="col-sm-6 col-md-3">
                        <select name="property" class="form-control">
                            <option value="">-- {{ __('Property') }}</option>

                            @if($properties)
                                @foreach($properties as $translatedProperty)
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
                    <div class="col-sm-6 col-md-3">
                        <select name="transaction_type" class="form-control">
                            <option value="">-- {{ __('Transaction Type') }}</option>

                            @if($transactionTypes)
                                @foreach($transactionTypes as $translatedTransactionType)
                                    @php 
                                        $selected = $searchedTransaction == $translatedTransactionType->transaction_type_id ? 'selected' : ''; 
                                    @endphp

                                    <option value="{{ $translatedTransactionType->transaction_type_id }}" {{ $selected }}>
                                        {{ $translatedTransactionType->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="city" class="form-control">
                            <option value="">-- {{ __('City') }}</option>

                            @if($cities)
                                @foreach($cities as $city)
                                    @php 
                                        $selected = $searchedCity == $city->id ? 'selected' : ''; 
                                    @endphp

                                    <option value="{{ $city->id }}" {{ $selected }}>
                                        {{ $city->name }}
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
                            @foreach($withImageOptions as $value => $label)
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