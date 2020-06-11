@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('properties'),
                'label' => __('Properties'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('properties.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!--- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('properties.partials.form', [
                'row' => $property,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection