@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    if ($booking->is_confirmed) {
        $actions = [
            [
                'label' => __('Add Payment'),
                'url' => route('property-booking-payments.create', [$booking->id]),
                'icon' => 'i-Add',
            ],
        ];
    } else {
        $actions = [];
    }
    @endphp

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('property-bookings.by-property', [$property->id]),
    'label' => __('Bookings'),
    ],
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
        @if (!isRole('owner'))
            @if (!$transactions)
                <!-- load table transactions -->
                @include('property-bookings.partials.table-transactions', [
                'label' => __('TRANSACTIONS'),
                'transactions' => $transactions
                ])
            @endif
        @endif
        <form action="{{ route('property-bookings.update', [$booking->id]) }}" method="post">
            @csrf
            @include('property-bookings.partials.form', [
            'row' => $booking,
            'property' => $property,
            ])
        </form>
    </div>

@endsection
