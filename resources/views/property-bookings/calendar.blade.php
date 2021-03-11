@extends('layouts.horizontal-master')

@section('heading-content')
    @php
    if (isset($property)) {
        $propertyUser = false;
        foreach ($property->users as $user) {
            if ($user->id == \UserHelper::getCurrentUserID()) {
                $propertyUser = true;
            }
        }
        if ($propertyUser || isRole('super') || isRole('admin')) {
            $actions = [
                [
                    'label' => __('Add Booking'),
                    'url' => route('property-bookings.create', [$property->id]),
                    'icon' => 'i-Add',
                ],
            ];
        } else {
            $actions = [];
        }
    } else {
        $actions = [];
    }
    @endphp

    @include('components.heading', [
    'label' => __('Availability Calendar'),
    'breadcrumbs' => [
    [
    'url' => route('property-bookings.by-property', [$property->id]),
    'label' => __('Bookings'),
    ],
    ],
    'actions' => $actions
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

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table-calendar', [
    'label' => __('Bookings'),
    'rows' => $bookings
    ])

@endsection
