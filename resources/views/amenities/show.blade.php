@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('amenities'),
                'label' => __('Amenities'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('amenities.create'),
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

            <!-- form fields -->
            @include('amenities.partials.form', [
                'row' => $amenity,
                'disabled' => true
            ])        

        </form>
    </div>

@endsection
