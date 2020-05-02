@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
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
        <form action="{{ route('property-rates.update', [$property->id, $rate->id]) }}" method="post">
            @csrf
            @include('property-rates.partials.form', [
                'row' => $rate
            ])        
        </form>
    </div>

@endsection
