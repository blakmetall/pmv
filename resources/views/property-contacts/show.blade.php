@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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
        <form action="" onsubmit="return false;" method="post">
            @include('property-contacts.partials.form', [
                'row' => $contact,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
