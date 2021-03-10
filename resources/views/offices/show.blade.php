@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('View'),
    'breadcrumbs' => [
    [
    'url' => route('offices'),
    'label' => __('Offices'),
    ],
    ],
    'actions' => [
    [
    'url' => route('offices'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('offices.create'),
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
            @include('offices.partials.form', [
            'row' => $office,
            'disabled' => true
            ])
        </form>
    </div>

@endsection
