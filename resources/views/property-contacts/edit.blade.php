@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('property-contacts', [$property->id]),
                'label' => __('Contacts'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-contacts.create', [$property->id]),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('property-contacts.update', [$property->id, $contact->id]) }}" method="post">
            @csrf
            @include('property-contacts.partials.form', [
                'row' => $contact
            ])        
        </form>
    </div>

@endsection
