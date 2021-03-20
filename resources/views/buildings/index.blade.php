@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Buildings'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('buildings.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('buildings')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('buildings.partials.table', [
        'label' => __('Building'),
        'rows' => $buildings
    ])

@endsection
