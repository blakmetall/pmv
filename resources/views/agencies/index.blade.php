@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [];
    $actions = [
    [
    'label' => __('New'),
    'url' => route('agencies.create'),
    'icon' => 'i-Add',
    ]
    ];
    @endphp

    @include('components.heading', [
    'label' => __('Agencies'),
    'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('agencies')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('agencies.partials.table', [
    'label' => __('Agencies'),
    'rows' => $agencies
    ])

@endsection
