@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Contractors'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contractors.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('contractors')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('contractors.partials.table', [
        'label' => __('Contractors'),
        'rows' => $contractors
    ])

@endsection