@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('workgroups'),
                'label' => __('Workgroups'),
            ],
        ],
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

    <div class="container app-container">
        <form action="" onsubmit="return false;" method="post">

            <!-- form fields -->
            @include('workgroups.partials.form', [
                'row' => $workgroup,
                'cities' => $cities,
                'disabled' => true,
            ])

        </form>
    </div>

@endsection
