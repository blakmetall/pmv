@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('contacts'),
                'label' => __('Contacts'),
            ],
        ],
        'actions' => [
            [
                'url' => route('contacts'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('contacts.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('contacts.partials.form', [
                'row' => $contact,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
