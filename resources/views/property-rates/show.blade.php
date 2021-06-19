@extends('layouts.horizontal-master')

@section('heading-content')

    @php
        $btns = [];

        if(can('edit', 'property-rates')){
            $btns[] = [
                'label' => __('New'),
                'url' => route('property-rates.create', [$property->id]),
                'icon' => 'i-Add',
            ];
        }
    @endphp

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-rates', [$property->id]),
                'label' => __('Rates'),
            ],
        ],
        'actions' => $btns,
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
        <form action="" onsubmit="return false;" method="post">
            @include('property-rates.partials.form', [
                'row' => $rate,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
