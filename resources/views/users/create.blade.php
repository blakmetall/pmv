@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('users'),
                'label' => __('Users'),
            ],
        ],
        'actions' => [
            [
                'url' => route('users'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('users.store') }}" method="post">
            @csrf

            <!-- form fields -->
            @include('users.partials.form', [
                'row' => $user,
                'roles' => $roles,
            ])        
        </form>
    </div>
@endsection