@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Staff Groups'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('staff-groups.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('staff-groups')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('staff-groups.partials.table', [
        'label' => __('Staff Groups'),
        'rows' => $staff_groups
    ])

@endsection
