@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Notes'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-notes.create', [$property->id]),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
        'propertyID' => $property->id,
        'property' => $property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-notes', [$property->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-notes.partials.table', [
        'label' => __('Notes'),
        'rows' => $notes
    ])

@endsection