@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => $workgroup->city->name,
        'breadcrumbs' => [
            [
                'url' => route('workgroups'),
                'label' => __('Workgroups'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('workgroup-users.create', [$workgroup->id]),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('workgroup-users', [$workgroup->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('workgroup-users.partials.table', [
        'label' => __('Workgroup') . ' : ' . $workgroup->city->name,
        'rows' => $workgroupUsers
    ])

@endsection