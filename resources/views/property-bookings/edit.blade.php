@extends('layouts.horizontal-master')

@section('heading-content')

    @php
        foreach ($property->management as $pm) {
            if (!$pm->is_finished) {
                $url = route('property-management-transactions.create', $pm->id);
                break;
            }
        }

        if($booking->is_confirmed){
            $actions = [
                [
                    'label' => __('Add Payment'),
                    'url' => route('property-booking-payments.create', $booking->id),
                    'icon' => 'i-Add',
                ],
                [
                    'label' => __('Add PM Credit'),
                    'url' => $url,
                    'icon' => 'i-Add',
                ]
            ];
        }else{
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
        <form action="{{ route('property-bookings.update', [$booking->id]) }}" method="post">
            @csrf
            @include('property-bookings.partials.form', [
                'row' => $booking,
                'property' => $property,
            ])
        </form>
    </div>

@endsection
