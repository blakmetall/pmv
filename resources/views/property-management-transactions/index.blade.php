@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-management-transactions.create', [$pm->id]),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('property-management-transactions.partials.search', [
        'url' => route('property-management-transactions', [$pm])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management-transactions.partials.table', [
        'label' => __('Transactions'),
        'rows' => $transactions,
        'showBalanceColumn' => true,
        'currentBalance' => $currentBalance,
    ])

@endsection
