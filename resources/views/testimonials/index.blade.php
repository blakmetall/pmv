@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [];
    $actions = [
    [
    'label' => __('New'),
    'url' => route('testimonials.create'),
    'icon' => 'i-Add',
    ]
    ];
    @endphp

    @include('components.heading', [
    'label' => __('Testimonials'),
    'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('testimonials')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('testimonials.partials.table', [
    'label' => __('Testimonials'),
    'rows' => $testimonials
    ])

@endsection
