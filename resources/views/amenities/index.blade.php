@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Amenities'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('amenities.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('amenities')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('amenities.partials.table', [
        'label' => __('Amenities'),
        'rows' => $amenities
    ])

@endsection
