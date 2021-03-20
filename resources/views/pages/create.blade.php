@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('New'),
    'breadcrumbs' => [
    [
    'url' => route('pages'),
    'label' => __('Pages'),
    ],
    ],
    'actions' => [
    [
    'url' => route('pages'),
    'icon' => 'i-Receipt-4',
    ],
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('pages.store') }}" method="post">
            @csrf

            @include('pages.partials.form', [
            'row' => $page,
            ])
        </form>
    </div>

@endsection
