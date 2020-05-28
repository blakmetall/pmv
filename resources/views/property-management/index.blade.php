@extends('layouts.horizontal-master')

@section('heading-content')
    @if($property != 'all')
        @php
            $actions_config = [
                'label' => __('New'),
                'url' => route('property-management.create', [$property->id])
            ]
        @endphp
    @else
        @php
            $actions_config = [
                'label' => __('New'),
                'url' => route('properties')
            ]
        @endphp
    @endif
    @include('components.heading', [
        'label' => __('Property Management'),
        'actions' => [
            $actions_config
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-management', [$property])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management.partials.table', [
        'label' => __('Property Management'),
        'rows' => $pm_items
    ])

@endsection
