@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Transaction Types'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('transaction-types.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('transaction-types')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('transaction-types.partials.table', [
        'label' => __('Transaction Types'),
        'rows' => $transaction_types
    ])

@endsection
