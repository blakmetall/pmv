@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('pages'),
    'label' => __('Pages'),
    ],
    ],
    'actions' => [
    [
    'url' => route('pages'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('pages.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('pages.partials.form', [
            'row' => $page,
            'disabled' => true
            ])
        </form>
    </div>

@endsection
