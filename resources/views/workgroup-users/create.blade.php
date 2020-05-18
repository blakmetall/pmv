@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('workgroup-users', [$workgroup->id]),
                'label' => $workgroup->city->name
            ],
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


    <div class="container app-container-sm">
        <form action="{{ route('workgroup-users.store', [$workgroup->id]) }}" method="post">
            @csrf
            @include('workgroup-users.partials.form', [
                'row' => $workgroupUser
            ])
        </form>
    </div>

@endsection
