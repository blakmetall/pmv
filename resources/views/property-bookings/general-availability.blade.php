@extends('layouts.horizontal-master')
@php
    $url = isset($url) ? $url : '';
    $currentDate = date('Y-m-d', strtotime('now'));
    $fromDate = (isset($_GET['from_date'])) ? $_GET['from_date'] : $currentDate;
    $endDate = date('Y-m-d', strtotime($fromDate . '+ 13 days'));
    $beds  = (isset($_GET['beds'])) ? $_GET['beds'] : '';
    $baths = (isset($_GET['baths'])) ? $_GET['baths'] : '';
    $pax   = (isset($_GET['pax'])) ? $_GET['pax'] : '';
    $isManaged = isset($_GET['managed']) ? $_GET['managed'] : '';
    $searchedLocation = isset($_GET['location']) ? $_GET['location'] : '';
    
    if($isManaged){
        if($_GET['managed'] == 1){
            $selectedManaged = 1;
        }else{
            $selectedManaged = 2;
        }
    }else{
        $selectedManaged = '';
    }
    
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

    @include('components.search-general-availability', [
        'url' => route('property-bookings.general-availability')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-bookings.partials.table-general-availability', [
        'label' => __('Bookings'),
        'properties' => $properties,
    ])

@endsection
