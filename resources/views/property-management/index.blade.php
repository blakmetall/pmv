@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Property Management'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-management.create', [$property->id])
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-management', [$property->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management.partials.table', [
        'label' => __('Property Management'),
        'rows' => $pm_items
    ])

@endsection