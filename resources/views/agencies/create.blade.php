@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('New'),
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
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('agencies.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('agencies.partials.form', [
            'row' => $agency,
            ])
        </form>
    </div>

@endsection
