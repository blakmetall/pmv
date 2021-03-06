@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('contractors'),
                'label' => __('Contractors'),
            ],
        ],
        'actions' => [
            [
                'url' => route('contractors'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('contractors.create'),
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
            @include('contractors.partials.form', [
                'row' => $contractor,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
