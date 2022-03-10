@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];
    @endphp

    @include('components.heading', [
        'label' => __('Create'),
        'breadcrumbs' => [
            [
                'url' => route('property-check-list', [$property->id]),
                'label' => __('PM Check List'),
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
        <form action="{{ route('property-check-list.store', [$property->id]) }}" method="post">
            @csrf
            @include('property-check-list.partials.form', [
                'row' => $checkList,
            ])
        </form>
    </div>

@endsection
