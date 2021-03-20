@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [];
    $actions = [
    [
    'label' => __('New'),
    'url' => route('lgbts.create'),
    'icon' => 'i-Add',
    ]
    ];
    @endphp

    @include('components.heading', [
    'label' => __('LGBT'),
    'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('lgbts')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('lgbts.partials.table', [
    'label' => __('LGBT'),
    'rows' => $lgbts
    ])

@endsection
