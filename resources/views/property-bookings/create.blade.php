@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-bookings.by-property', [$property->id]),
                'label' => __('Bookings'),
            ],
        ]
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
        <form action="{{ route('property-bookings.store', [$property->id]) }}" method="post">
            @csrf
            @include('property-bookings.partials.form', [
                'row' => $booking,
                'property' => $property,
            ])
        </form>
    </div>

@endsection
