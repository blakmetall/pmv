@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('New'),
    'breadcrumbs' => [
    [
    'url' => route('lgbts'),
    'label' => __('LGBT'),
    ],
    ],
    'actions' => [
    [
    'url' => route('lgbts'),
    'icon' => 'i-Receipt-4',
    ],
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('lgbts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('lgbts.partials.form', [
            'row' => $lgbt,
            ])
        </form>
    </div>

@endsection
