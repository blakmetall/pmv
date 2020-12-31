@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
    'breadcrumbs' => [
    [
    'url' => route('agencies'),
    'label' => __('Agencies'),
    ],
    ],
    'actions' => [
    [
    'url' => route('agencies'),
    'icon' => 'i-Receipt-4',
    ],
    [
    'label' => __('New'),
    'url' => route('agencies.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('agencies.update', [$agency->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('agencies.partials.form', [
            'row' => $agency,
            ])
        </form>
    </div>

@endsection
