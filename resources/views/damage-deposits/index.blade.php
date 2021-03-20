@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Damage Deposits'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('damage-deposits.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('damage-deposits')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('damage-deposits.partials.table', [
        'label' => __('Damage Deposits'),
        'rows' => $damage_deposits
    ])

@endsection