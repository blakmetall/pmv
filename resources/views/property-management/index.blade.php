@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('property-management.create', [$property->id]),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Property Management'),
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

    @if (isset($pm))
        @include('property-management.partials.search-general', [
            'url' => route('property-management', [$pm]),
            'pm' => $pm,
        ])
    @endif

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management.partials.table', [
        'label' => __('Property Management'),
        'rows' => $pm_items,
        'active' => $active,
        'total' => $total,
        'finished' => $finished,
    ])

@endsection
