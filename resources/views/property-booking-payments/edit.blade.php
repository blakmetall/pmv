@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [
        [
            'label' => __('Add Payment'),
            'url' => route('property-booking-payments.create', [$booking->id]),
            'icon' => 'i-Add',
        ],
    ];
    @endphp

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('property-booking-payments', [$booking->id]),
    'label' => __('Payments'),
    ],
    ],
    ])

    <!-- separator -->
    <div class="mb-4"></div>
    @include('properties.partials.info', [
    'propertyID' => $property->id,
    'property' => $property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('property-booking-payments.update', [$payment->id]) }}" method="post">
            @csrf
            @include('property-booking-payments.partials.form', [
            'row' => $payment,
            'property' => $property,
            ])
        </form>
    </div>

@endsection
