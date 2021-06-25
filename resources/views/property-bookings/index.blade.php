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
        @endif
    @endif

    @include('components.heading', [
        'label' => __('Bookings'),
        'actions' => []
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search-bookings', [
        'url' => $url
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
