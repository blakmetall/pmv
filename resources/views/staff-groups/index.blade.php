@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Staff Groups'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('workgroup.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('workgroup')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('workgroup.partials.table', [
        'label' => __('Staff Groups'),
        'rows' => $staff_groups
    ])

@endsection
