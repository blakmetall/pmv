@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('transaction-types'),
                'label' => __('Transaction Types'),
            ],
        ],
        'actions' => [
            [
                'url' => route('transaction-types'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('transaction-types.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('transaction-types.update', [$transaction_type->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('transaction-types.partials.form', [
                'row' => $transaction_type
            ])        
        </form>
    </div>

@endsection
