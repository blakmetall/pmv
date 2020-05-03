@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Cleaning Staff'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-staff.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('cleaning-staff')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('cleaning-staff.partials.table', [
        'label' => __('Cleaning Staff'),
        'rows' => $cleaning_staff
    ])

@endsection
