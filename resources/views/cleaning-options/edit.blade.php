@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-options'),
                'label' => __('Cleaning Options'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-options.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('cleaning-options.update', [$cleaning_option->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('cleaning-options.partials.form', [
                'row' => $cleaning_option
            ])        
        </form>
    </div>

@endsection
