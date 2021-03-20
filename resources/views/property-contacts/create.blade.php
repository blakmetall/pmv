@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading-modal', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('property-contacts', [$property->id]),
                'label' => __('Contacts'),
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
        <form action="{{ route('property-contacts.store', [$property->id]) }}" method="post">
            @csrf
            @include('property-contacts.partials.form', [
                'row' => $property,
                'contacts' => $contacts,
            ])
        </form>
    </div>

@endsection
