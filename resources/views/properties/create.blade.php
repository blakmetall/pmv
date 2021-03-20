@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading-modal', [
        'label' => __('New'),
        'labelUser' => __('New User'),
        'route' => 'users',
        'breadcrumbs' => [
            [
                'url' => route('properties'),
                'label' => __('Properties'),
            ],
        ],
        'actions' => [
            [
                'url' => route('properties'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('properties.store') }}" method="post">
            @csrf

            @include('properties.partials.form', [
                'row' => $property,
            ])
        </form>
    </div>

@endsection
