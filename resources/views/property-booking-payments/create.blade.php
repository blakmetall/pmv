@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-booking-payments', [$booking->id]),
                'label' => __('Payments'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('property-booking-payments.store', [$booking->id]) }}" method="post">
            @csrf
            @include('property-booking-payments.partials.form', [
                'row' => $booking,
            ])
        </form>
    </div>

@endsection
