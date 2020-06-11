@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('property-management-transactions', [$pm->id]),
                'label' => __('Property Management Transactions'),
            ],
        ],
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

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('property-management-transactions.update', [$pm->id, $transaction->id]) }}" method="post">
            @csrf
            @include('property-management-transactions.partials.form', [
                'row' => $transaction
            ])        
        </form>
    </div>

@endsection
