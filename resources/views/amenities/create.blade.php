@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
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
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('amenities.store') }}" method="post">
            @csrf
            
            @include('amenities.partials.form', [
                'row' => $amenity
            ])        
        </form>
    </div>

@endsection
