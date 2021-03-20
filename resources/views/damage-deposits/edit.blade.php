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
                'url' => route('damage-deposits'),
                'icon' => 'i-Receipt-4',
            ],
            [
                'label' => __('New'),
                'url' => route('damage-deposits.create'),
                'icon' => 'i-Add',
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