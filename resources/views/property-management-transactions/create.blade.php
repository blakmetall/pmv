@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-management-transactions', [$pm->id]),
                'label' => __('Property Management Transactions'),
            ],
        ]
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
        <form action="{{ route('property-management-transactions.store', [$pm->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('property-management-transactions.partials.form', ['row' => $transaction])
        </form>
    </div>

@endsection
