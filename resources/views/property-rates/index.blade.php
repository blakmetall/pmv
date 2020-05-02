@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Rates'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-rates.create', [$property->id])
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-rates', [$property->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-rates.partials.table', [
        'label' => __('Rates'),
        'rows' => $rates
    ])

@endsection