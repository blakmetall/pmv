@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('contractors'),
                'label' => __('Contractors'),
            ],
        ],
        'actions' => [
            [
                'url' => route('contractors'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('contractors.store') }}" method="post">
            @csrf
            @include('contractors.partials.form', ['row' => $contractor])
        </form>
    </div>

@endsection
