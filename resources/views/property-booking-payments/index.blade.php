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
    'label' => __('Payments'),
    'breadcrumbs' => [
    [
    'url' => route('property-bookings'),
    'label' => __('Bookings'),
    ],
    [
    'url' => route('property-bookings.edit', [$booking->id]),
    'label' => __('Current Booking'),
    ],
    ],
    'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
    'propertyID' => $booking->property->id,
    'property' => $booking->property
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-booking-payments.partials.table', [
    'label' => __('Payments'),
    'rows' => $payments
    ])

@endsection
