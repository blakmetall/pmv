@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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

            <!-- form fields -->
            @include('contractors-services.partials.form', [
                'row' => $service,
                'disabled' => true
            ])        

        </form>
    </div>

@endsection
