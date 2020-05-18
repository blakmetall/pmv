@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Contact'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contacts.create')
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
