@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('property-rates', [$property->id]),
                'label' => __('Rates'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-rates.create', [$property->id]),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('property-rates.partials.form', [
                'row' => $rate,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
