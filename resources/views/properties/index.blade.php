@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Properties'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('properties.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('properties')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('properties.partials.table', [
        'label' => __('Properties'),
        'rows' => $properties
    ])

@endsection