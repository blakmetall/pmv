@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];

        if(!isRole('owner') && !isRole('contact')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('property-management.create', [$property->id]),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('property-management', [$property->id]),
                'label' => __('Property Management'),
            ],
        ],
        'actions' => $actions
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
        <form action="{{ route('property-management.update', [$property->id, $pm->id]) }}" method="post">
            @csrf
            @include('property-management.partials.form', [
                'row' => $pm
            ])        
        </form>
    </div>

@endsection
