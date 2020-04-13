@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('damage-deposits'),
                'label' => __('Damage Deposits'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('damage-deposits.store') }}" method="post">
            @csrf

            @include('damage-deposits.partials.form', [
                'row' => $damage_deposit,
            ])        
        </form>
    </div>

@endsection
