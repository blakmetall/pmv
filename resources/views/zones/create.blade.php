@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('New'),
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
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('zones.store') }}" method="post">
            @csrf

            @include('zones.partials.form', [
                'row' => $zone,
                'cities' => $cities,
            ])        
        </form>
    </div>

@endsection
