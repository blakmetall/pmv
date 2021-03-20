@extends('layouts.horizontal-master')

@section('heading-content')
    @php
        $actions = [];

        if (!isRole('owner')){
            $actions = array_merge($actions, [
                [
                    'label' => __('Create Contact'),
                    'url' => route('contacts.create'),
                ],
                [
                    'label' => __('Assign Contacts'),
                    'url' => route('property-contacts.create', [$property->id]),
                    'icon' => 'i-Add-User',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Contacts'),
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

    <!-- here the data is loaded -->
    @include('property-contacts.partials.table', [
        'label' => __('Contacts'),
        'rows' => $contacts
    ])

@endsection
