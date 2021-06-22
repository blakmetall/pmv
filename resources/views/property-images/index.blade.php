@extends('layouts.horizontal-master')

@section('heading-content')

    @php
        $btns = [];

        if(can('edit', 'property-images')){
            $btns = [
                'label' => __('Images'),
                'actions' => [
                    [
                        'label' => __('New'),
                        'url' => route('property-images.create', [$property->id]),
                        'icon' => 'i-Add',
                    ]
                ]
            ];
        }
    @endphp

    @include('components.heading', $btns)

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
    @include('property-images.partials.table', [
        'label' => __('Images'),
        'rows' => $images,
        'property' => $property,
    ])

@endsection
