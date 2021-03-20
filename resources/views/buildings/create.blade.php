@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('buildings'),
                'label' => __('Buildings'),
            ],
        ],
        'actions' => [
            [
                'url' => route('buildings'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('buildings.store') }}" method="post">
            @csrf
            @include('buildings.partials.form', ['row' => $building])
        </form>
    </div>

@endsection
