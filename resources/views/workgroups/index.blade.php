@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Workgroups'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('workgroups.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    @include('workgroups.partials.table', [
        'label' => __('Workgroups'),
        'rows' => $workgroups
    ])

@endsection



