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
                'url' => route('workgroups'),
                'icon' => 'i-Receipt-4',
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