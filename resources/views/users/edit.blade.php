@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('users'),
                'label' => __('Users'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('users.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('users.update', [$user->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('users.partials.form', [
                'row' => $user
            ])        
        </form>
    </div>

@endsection