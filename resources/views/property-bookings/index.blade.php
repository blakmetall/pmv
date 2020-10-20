@extends('layouts.horizontal-master')

@section('heading-content')
    @php
        if(isset($property)){
            $actions = [
                [
                    'label' => __('Add Booking'),
                    'url' => route('property-bookings.create', $property->id),
                    'icon' => 'i-Add',
                ]
            ];
        }else{
            $actions = [];
        }
    @endphp

    @include('components.heading', [
        'label' => __('Bookings'),
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table', [
        'label' => __('Bookings'),
        'rows' => $bookings
    ])

@endsection
