@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
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
        <form action="{{ route('workgroup-users.update', [$workgroup->id, $workgroupUser->id]) }}" method="post">
            @csrf
            @include('workgroup-users.partials.form', [
                'row' => $workgroupUser
            ])        
        </form>
    </div>

@endsection
