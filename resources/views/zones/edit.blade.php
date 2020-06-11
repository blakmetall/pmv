@extends('layouts.horizontal-master')

@section('heading-content')

     @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('zones'),
                'label' => __('Zones'),
            ],
        ],
        'actions' => [
            [
                'url' => route('zones'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('zones.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('zones.update', [$zone->id]) }}" method="post">
            @csrf

            @include('zones.partials.form', [
                'row' => $zone,
                'cities' => $cities,
            ])        
        </form>
    </div>

@endsection