@extends('layouts.horizontal-master')

@php
    $fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : '';
    $propertyId = isset($_GET['property_id']) ? $_GET['property_id'] : '';
    $registerBy = isset($_GET['register_by']) ? $_GET['register_by'] : '';
    $url = route('property-check-list', [$property->id]);
@endphp

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner') && can('edit', 'property-check-list')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('property-check-list.create', [$property->id]),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Check List'),
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

    @include('components.search-check-list', [
        'url' => $url
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-check-list.partials.table', [
        'label' => __('Notes'),
        'rows' => $checkLists
    ])

@endsection