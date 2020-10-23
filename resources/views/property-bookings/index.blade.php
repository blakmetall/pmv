@extends('layouts.horizontal-master')

@php
    $fromDate = (isset($_GET['from_date'])) ? $_GET['from_date'] : '';
    $toDate = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
    $searchedLocation = isset($_GET['location']) ? $_GET['location'] : '';
@endphp

@section('heading-content')
    @php
        if(isset($property)){
            if($property->user->id == \UserHelper::getCurrentUserID() || isRole('super') || isRole('admin')){
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

    @include('components.search-arrivals-departures', [
        'url' => route('property-bookings')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table', [
        'label' => __('Bookings'),
        'rows' => $bookings
    ])

@endsection
