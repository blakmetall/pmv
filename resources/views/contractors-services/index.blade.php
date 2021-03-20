@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Services'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contractors-services.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('contractors-services')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('contractors-services.partials.table', [
        'label' => __('Services'),
        'rows' => $services
    ])

@endsection
