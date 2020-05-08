@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('staff-groups'),
                'label' => __('Staff Groups'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('staff-groups.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('staff-groups.update', [$staff_group->id]) }}" method="post">
            @csrf
            @include('staff-groups.partials.form', [
                'row' => $staff_group
            ])
        </form>
    </div>

@endsection
