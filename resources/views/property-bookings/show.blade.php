@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-bookings'),
                'label' => __('Bookings'),
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

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="container app-container-sm">
                <form action="" onsubmit="return false;" method="post">
                    @include('property-bookings.partials.form', [
                        'row' => $booking,
                        'property' => $property,
                        'disabled' => true
                    ])        
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-5">
            @include('property-bookings.partials.booking-payments', [
                'booking' => $booking,
                'property' => $property,
            ])
        </div>
    </div>

@endsection
