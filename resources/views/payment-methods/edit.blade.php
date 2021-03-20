@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('payment-methods'),
    'label' => __('Payment Methods'),
    ],
    ],
    'actions' => [
    [
    'url' => route('payment-methods'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('payment-methods.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('payment-methods.update', [$paymentMethod->id]) }}" method="post">
            @csrf

            @include('payment-methods.partials.form', [
            'row' => $paymentMethod,
            ])
        </form>
    </div>

@endsection
