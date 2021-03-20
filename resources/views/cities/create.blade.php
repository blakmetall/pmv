@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Create'),
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
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container">
        <form action="{{ route('cities.store') }}" method="post">
            @csrf

            @include('cities.partials.form', [
                'row' => $city,
                'states' => $states,
            ])
        </form>
    </div>

@endsection