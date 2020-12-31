@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('lgbts'),
    'label' => __('LGBT'),
    ],
    ],
    'actions' => [
    [
    'url' => route('lgbts'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('lgbts.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('lgbts.update', [$lgbt->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('lgbts.partials.form', [
            'row' => $lgbt,
            ])
        </form>
    </div>

@endsection
