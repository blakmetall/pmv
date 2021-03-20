@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-services'),
                'label' => __('Cleaning Services'),
            ],
        ],
        'actions' => [
            [
                'url' => route('cleaning-services'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('cleaning-services.store') }}" method="post">
            @csrf
            @include('cleaning-services.partials.form', ['row' => $cleaning_service])
        </form>
    </div>

@endsection
