@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [
            [
                'url' => route('properties'),
                'icon' => 'i-Receipt-4',
            ],
        ];

        if(!isRole('owner')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('properties.create'),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

     @include('components.heading-modal', [
        'label' => __('Edit'),
        'labelUser' => __('New User'),
        'route' => 'users',
        'breadcrumbs' => [
            [
                'url' => route('properties'),
                'label' => __('Properties'),
            ],
        ],
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
        'propertyID' => $property->id,
        'property' => $property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('properties.update', [$property->id]) }}" method="post">
            @csrf

            @include('properties.partials.form', [
                'row' => $property,
            ])        
        </form>
    </div>

@endsection