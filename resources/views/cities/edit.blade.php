@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('cities'),
                'label' => __('Cities'),
            ],
        ],
        'actions' => [
            [
                'url' => route('cities'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('cities.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    
    <div class="container app-container">
        <form action="{{ route('cities.update', [$city->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('cities.partials.form', [
                'row' => $city,
                'states' => $states,
            ])
        </form>
    </div>

@endsection