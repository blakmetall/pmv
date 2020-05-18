@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('human-resources'),
                'label' => __('Human Resources'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('human-resources.store') }}" method="post">
            @csrf
            @include('human-resources.partials.form', ['row' => $human_resource])
        </form>
    </div>

@endsection
