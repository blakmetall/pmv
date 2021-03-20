@extends('layouts.horizontal-master')

@php
$fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$toDate = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$searchedLocation = isset($_GET['location']) ? $_GET['location'] : '';
$url = isset($propertyId) ? route('property-bookings.by-property', [$propertyId]) : route('property-bookings');
@endphp

@section('heading-content')
    @if (isset($property))
        @if ($property->users->isNotEmpty())
            @php
                $propertyUser = false;
            @endphp
            @foreach ($property->users as $user)
                @if ($user->id == \UserHelper::getCurrentUserID())
                    @php
                        $propertyUser = true;
                    @endphp
                @endif
            @endforeach
            @if ($propertyUser || isRole('super') || isRole('admin'))
                @php
                    $actions = [
                        [
                            'label' => __('Add Booking'),
                            'url' => route('property-bookings.create', $property->id),
                            'icon' => 'i-Add',
                        ],
                    ];
                @endphp
            @else
                @php
                    $actions = [];
                @endphp
            @endif
        @else
            @if ($property->user->id || isRole('super') || isRole('admin'))
                @php
                    $actions = [
                        [
                            'label' => __('Add Booking'),
                            'url' => route('property-bookings.create', $property->id),
                            'icon' => 'i-Add',
                        ],
                    ];
                @endphp
            @else
                @php
                    $actions = [];
                @endphp
            @endif
        @endif
    @else
        @php
            $actions = [];
        @endphp
    @endif

    @include('components.heading', [
    'label' => __('Bookings'),
    'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search-bookings', [
    'url' => $url
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table', [
    'label' => __('Bookings'),
    'rows' => $bookings
    ])

@endsection
