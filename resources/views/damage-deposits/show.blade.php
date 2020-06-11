@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!--- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('damage-deposits.partials.form', [
                'row' => $damage_deposit,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection