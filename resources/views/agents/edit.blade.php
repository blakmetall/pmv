@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('agents'),
                'label' => __('Agents'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('agents.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')    
    <div class="container app-container-sm">
        <form action="{{ route('agents.update', [$user->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('agents.partials.form', [
                'row' => $user,
                'roles' => $roles,
            ])        
        </form>
    </div>

@endsection