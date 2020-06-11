@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('human-resources'),
                'label' => __('Human Resources'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('human-resources.create'),
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
            @include('human-resources.partials.form', [
                'row' => $human_resource,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
