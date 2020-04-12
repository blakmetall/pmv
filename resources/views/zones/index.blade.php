@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Zones'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('zones.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('zones')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('zones.partials.table', [
        'label' => __('Zones'),
        'rows' => $zones
    ])

@endsection