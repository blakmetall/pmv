@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-staff'),
                'label' => __('Cleaning Staff'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-staff.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('cleaning-staff.partials.form', [
                'row' => $cleaning_staff,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
