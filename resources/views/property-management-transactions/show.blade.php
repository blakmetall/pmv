@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('property-management-transactions.partials.form', [
                'row' => $transaction,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
