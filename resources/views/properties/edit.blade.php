@extends('layouts.horizontal-master')

@section('heading-content')

     @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('properties'),
                'label' => __('Properties'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('properties.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('partials.properties-stepper', [
        'renderStepper' => !$row->register_completed,
        'activeStep' => 1
    ])

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('properties.update', [$property->id]) }}" method="post">
            @csrf

            @include('properties.partials.form', [
                'row' => $property,
            ])        
        </form>
    </div>

@endsection