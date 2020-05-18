@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Create'),
        'breadcrumbs' => [
            [
                'url' => route('workgroups'),
                'label' => __('Workgroups'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container">
        <form action="{{ route('workgroups.store') }}" method="post">
            @csrf

            @include('workgroups.partials.form', [
                'row' => $workgroup,
                'cities' => $cities,
            ])
        </form>
    </div>

@endsection