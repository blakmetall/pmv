@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('New'),
    'breadcrumbs' => [
    [
    'url' => route('offices'),
    'label' => __('Offices'),
    ],
    ],
    'actions' => [
    [
    'url' => route('offices'),
    'icon' => 'i-Receipt-4',
    ],
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('offices.store') }}" method="post">
            @csrf
            @include('offices.partials.form', ['row' => $office])
        </form>
    </div>

@endsection
