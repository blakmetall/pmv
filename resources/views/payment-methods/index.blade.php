@extends('layouts.horizontal-master')

@section('heading-content')

    @php
    $actions = [];
    $actions = [
    [
    'label' => __('New'),
    'url' => route('payment-methods.create'),
    'icon' => 'i-Add',
    ]
    ];
    @endphp

    @include('components.heading', [
    'label' => __('Payment Methods'),
    'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('payment-methods')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('payment-methods.partials.table', [
    'label' => __('Payment Methods'),
    'rows' => $paymentMethods
    ])

@endsection
