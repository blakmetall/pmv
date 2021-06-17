@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [
            [
                'url' => route('properties'),
                'icon' => 'i-Receipt-4',
            ],
        ];

        if(!isRole('owner') && can('edit', 'properties')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('properties.create'),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('View'),
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