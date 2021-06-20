@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner') && can('edit', 'cleaning-services')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('cleaning-services.create'),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Cleaning Services'),
        'actions' => $actions,
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
