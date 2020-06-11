@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-services'),
                'label' => __('Cleaning Services'),
            ],
        ],
        'actions' => [
            [
                'url' => route('cleaning-services'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('cleaning-services.create'),
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
            @include('cleaning-services.partials.form', [
                'row' => $cleaning_service,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
