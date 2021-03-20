@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-rates', [$property->id]),
                'label' => __('Rates'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
        'propertyID' => $property->id,
        'property' => $property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('property-rates.store', [$property->id]) }}" method="post">
            @csrf
            @include('property-rates.partials.form', ['row' => $rate])
        </form>
    </div>

@endsection
