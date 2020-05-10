@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('workgroup'),
                'label' => __('Staff Groups'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('workgroup.store') }}" method="post">
            @csrf
            @include('workgroup.partials.form', ['row' => $staff_group])
        </form>
    </div>

@endsection
