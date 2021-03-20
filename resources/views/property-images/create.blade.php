@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-images', [$property->id]),
                'label' => __('Images'),
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
        <form action="{{ route('property-images.store', [$property->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('property-images.partials.form', ['row' => $image])
        </form>
    </div>

@endsection
