@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Cleaning Services'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-services.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('cleaning-services')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('cleaning-services.partials.table', [
        'label' => __('Cleaning Services'),
        'rows' => $cleaning_services
    ])

@endsection
