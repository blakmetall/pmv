@extends('layouts.horizontal-master')

@section('heading-content')

    @if(($pm != 'all') && ($pm != 'pending'))
        @php
            $actions_config = [
                'label' => __('New'),
                'url' => route('property-management-transactions.create', [$pm->id])
            ]
        @endphp
    @else
        @php
            $actions_config = [
                'label' => __('New'),
                'url' => route('properties')
            ]
        @endphp
    @endif

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
        'actions' => [
            $actions_config
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-management-transactions', [$pm])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management-transactions.partials.table', [
        'label' => __('Property Management Transactions'),
        'rows' => $transactions
    ])

@endsection
