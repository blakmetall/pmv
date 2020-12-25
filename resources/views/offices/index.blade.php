@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Offices'),
    'actions' => [
    [
    'label' => __('New'),
    'url' => route('offices.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('offices')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('offices.partials.table', [
    'label' => __('Office'),
    'rows' => $offices
    ])

@endsection
