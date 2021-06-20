@extends('layouts.horizontal-master')

@section('heading-content')

    @php
        $actions = [];

        if(!isRole('owner') && can('edit', 'property-bookings')) {
            $actions = [
                'label' => __('Add Payment'),
                'url' => route('property-booking-payments.create', [$booking->id]),
                'icon' => 'i-Add',
            ];
        }
    @endphp

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-booking-payments', [$booking->id]),
                'label' => __('Payments'),
            ],
        ],
        'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('property-booking-payments.partials.form', [
                'row' => $payment,
                'property' => $property,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
