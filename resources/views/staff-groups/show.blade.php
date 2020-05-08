@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
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
        <form action="" onsubmit="return false;" method="post">
            @include('staff-groups.partials.form', [
                'row' => $staff_group,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
