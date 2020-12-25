@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
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
        <form action="{{ route('offices.update', [$office->id]) }}" method="post">
            @csrf
            @include('offices.partials.form', [
            'row' => $office
            ])
        </form>
    </div>

@endsection
