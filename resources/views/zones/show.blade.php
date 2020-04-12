@extends('layouts.horizontal-master')


@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('zones'),
                'label' => __('Zones'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('zones.create'),
            ]
        ]
    ])

    <!--- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('zones.partials.form', [
                'row' => $zone,
                'disabled' => true,
                'cities' => $cities,
            ])        
        </form>
    </div>

@endsection