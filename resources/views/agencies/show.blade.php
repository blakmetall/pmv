@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('agencies'),
    'label' => __('Agencies'),
    ],
    ],
    'actions' => [
    [
    'url' => route('agencies'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('agencies.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('agencies.partials.form', [
            'row' => $agency,
            'disabled' => true
            ])
        </form>
    </div>

@endsection
