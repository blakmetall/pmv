@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('property-management-transactions.create', [$pm->id]),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
        'propertyID' => $pm->property->id,
        'property' => $pm->property
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
        'currentBalance' => $currentBalance,
        'useBalancePresentation' => true,
    ])

@endsection
