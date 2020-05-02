@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Contacts'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-contacts.create', [$property->id])
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-contacts', [$property->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-contacts.partials.table', [
        'label' => __('Contacts'),
        'rows' => $contacts
    ])

@endsection