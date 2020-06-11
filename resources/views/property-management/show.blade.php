@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-management', [$property->id]),
                'label' => __('Property Management'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-management.create', [$property->id]),
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
            @include('property-management.partials.form', [
                'row' => $pm,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
