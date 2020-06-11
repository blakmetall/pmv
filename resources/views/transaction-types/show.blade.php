@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('transaction-types'),
                'label' => __('Transaction Types'),
            ],
        ],
        'actions' => [
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
        <form action="" onsubmit="return false;" method="post">

            <!-- form fields -->
            @include('transaction-types.partials.form', [
                'row' => $transaction_type,
                'disabled' => true
            ])        

        </form>
    </div>

@endsection
