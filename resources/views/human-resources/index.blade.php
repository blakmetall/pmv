@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Human Resources'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('human-resources.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('human-resources')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('human-resources.partials.table', [
        'label' => __('Human Resources'),
        'rows' => $human_resources
    ])

@endsection
