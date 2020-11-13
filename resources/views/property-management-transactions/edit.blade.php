@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner') && !isRole('contact')) {
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
        'label' => __('Edit'),
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
        <form action="{{ route('property-management-transactions.update', [$pm->id, $transaction->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('property-management-transactions.partials.form', [
                'row' => $transaction
            ])        
        </form>
    </div>

@endsection
