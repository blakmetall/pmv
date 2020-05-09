@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('staff-groups'),
                'label' => __('Staff Groups'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('staff-groups.store') }}" method="post">
            @csrf
            @include('staff-groups.partials.form', ['row' => $staff_group])
        </form>
    </div>

@endsection
