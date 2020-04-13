@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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
        <form action="" onsubmit="return false;" method="post">
            @include('users.partials.form', [
                'row' => $user,
                'disabled' => true
            ])        
        </form>
    </div>
@endsection
