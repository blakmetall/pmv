@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('properties'),
                'label' => __('Properties'),
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
