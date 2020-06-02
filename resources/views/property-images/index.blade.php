@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Images'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-images.create', [$property->id])
            ]
        ]
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-images.partials.table', [
        'label' => __('Images'),
        'rows' => $images
    ])

@endsection
