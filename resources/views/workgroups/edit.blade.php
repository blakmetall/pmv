@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
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
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    
    <div class="container app-container">
        <form action="{{ route('workgroups.update', [$workgroup->id]) }}" method="post">
            @csrf

            <!-- form fields -->
            @include('workgroups.partials.form', [
                'row' => $workgroup,
                'cities' => $cities,
            ])
        </form>
    </div>

@endsection