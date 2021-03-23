@extends('layouts.horizontal-master')

@php
    $url = isset($url) ? $url : '';
    $currentDate = date('Y-m-d', strtotime('now'));
    $tomorrowDate = date('Y-m-d', strtotime('now + 1 day'));
    $fromDate = (isset($_GET['from_date'])) ? $_GET['from_date'] : $currentDate;
    $toDate = (isset($_GET['to_date'])) ? $_GET['to_date'] : $tomorrowDate;
    $searchedLocation = isset($_GET['location']) ? $_GET['location'] : 1;
    $currentLocation = \App\Models\City::find($searchedLocation);
@endphp

@section('heading-content')
    @php
        $actions = [];
    @endphp

    @include('components.heading', [
        'label' => __('Arrivals & Departures'),
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search-arrivals-departures', [
        'url' => route('property-bookings.arrivals-departures')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table-arrivals-departures', [
        'label_arrivals' => __('Arrivals'),
        'label_departures' => __('Departures'),
        'arrivals' => $arrivals,
        'departures' => $departures
    ])

@endsection
