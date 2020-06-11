@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('workgroup-users', [$workgroup->id]),
                'label' => $workgroup->city->name
            ],
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

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('workgroup-users.partials.form', [
                'row' => $workgroupUser,
                'disabled' => true
            ])        
        </div>
    </form>

@endsection
