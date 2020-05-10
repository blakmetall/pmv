@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-staff'),
                'label' => __('Cleaning Staff Users'),
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
        <form action="{{ route('cleaning-staff.update', [$cleaning_staff->id]) }}" method="post">
            @csrf
            @include('cleaning-staff.partials.form', [
                'row' => $cleaning_staff
            ])
        </form>
    </div>

@endsection
