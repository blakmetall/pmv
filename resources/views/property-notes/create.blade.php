@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-notes', [$property->id]),
                'label' => __('Notes'),
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
        <form action="{{ route('property-notes.store', [$property->id]) }}" method="post">
            @csrf
            @include('property-notes.partials.form', ['row' => $note])
        </form>
    </div>

@endsection
