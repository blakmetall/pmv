@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('amenities'),
                'label' => __('Amenities'),
            ],
        ],
        'actions' => [
            [
                'url' => route('amenities'),
                'icon' => 'i-Receipt-4',
            ],
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
        <form action="{{ route('amenities.update', [$amenity->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('amenities.partials.form', [
                'row' => $amenity
            ])        
        </form>
    </div>

@endsection
