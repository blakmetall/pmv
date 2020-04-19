@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('contractors'),
                'label' => __('Contractors'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('contractors.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('contractors.update', [$contractor->id]) }}" method="post">
            @csrf
            @include('contractors.partials.form', [
                'row' => $contractor
            ])        
        </form>
    </div>

@endsection
