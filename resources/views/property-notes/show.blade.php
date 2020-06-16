@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-notes', [$property->id]),
                'label' => __('Notes'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-notes.create', [$property->id]),
                'icon' => 'i-Add',
            ]
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
        <form action="" onsubmit="return false;" method="post">
            @include('property-notes.partials.form', [
                'row' => $note,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
