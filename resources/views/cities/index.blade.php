@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Cities'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cities.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('cities')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('cities.partials.table', [
        'label' => __('Cities'),
        'rows' => $cities
    ])

@endsection



