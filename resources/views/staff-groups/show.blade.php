@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('workgroup'),
                'label' => __('Staff Groups'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('workgroup.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('workgroup.partials.form', [
                'row' => $staff_group,
                'disabled' => true
            ])        
        </form>
    </div>

@endsection
