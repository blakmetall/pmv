@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('transaction-types'),
                'label' => __('Transaction Types'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('transaction-types.store') }}" method="post">
            @csrf
            
            @include('transaction-types.partials.form', [
                'row' => $transaction_type
            ])        
        </form>
    </div>

@endsection
