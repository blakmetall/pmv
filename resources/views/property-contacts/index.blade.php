@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Contacts'),
        'actions' => [
            [
                'label' => __('Assign Contacts'),
                'url' => route('property-contacts.create', [$property->id]),
                'icon' => 'i-Add-User',
            ]
        ]
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
