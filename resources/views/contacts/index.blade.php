@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Contacts'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contacts.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('contacts')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('contacts.partials.table', [
        'label' => __('Contact'),
        'rows' => $contacts
    ])

@endsection
