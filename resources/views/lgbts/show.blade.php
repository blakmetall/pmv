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

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('lgbts.partials.form', [
            'row' => $lgbt,
            'disabled' => true
            ])
        </form>
    </div>

@endsection
