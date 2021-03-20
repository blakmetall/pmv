@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [];
    $actions = [
    [
    'label' => __('New'),
    'url' => route('pages.create'),
    'icon' => 'i-Add',
    ]
    ];
    @endphp

    @include('components.heading', [
    'label' => __('Pages'),
    'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('pages')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('pages.partials.table', [
    'label' => __('Pages'),
    'rows' => $pages
    ])

@endsection
