@extends('layouts.horizontal-master')

@section('heading-content')

     @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('damage-deposits'),
                'label' => __('Damage Deposits'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('damage-deposits.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('damage-deposits.update', [$damage_deposit->id]) }}" method="post">
            @csrf

            @include('damage-deposits.partials.form', [
                'row' => $damage_deposit,
            ])        
        </form>
    </div>

@endsection