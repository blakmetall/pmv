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
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-management-transactions', [$pm->id]),
                'label' => __('Property Management Transactions'),
            ],
        ],
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
