@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('contractors-services'),
                'label' => __('Services'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contractors-services.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('contractors-services.update', [$service->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('contractors-services.partials.form', [
                'row' => $service
            ])        
        </form>
    </div>

@endsection
