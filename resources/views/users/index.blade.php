@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Users'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('users.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('users')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('users.partials.table', [
        'label' => __('Users'),
        'rows' => $users
    ])

@endsection