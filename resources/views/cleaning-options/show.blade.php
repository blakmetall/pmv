@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-options'),
                'label' => __('Cleaning Options'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-options.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">

            <!-- form fields -->
            @include('cleaning-options.partials.form', [
                'row' => $cleaning_option,
                'disabled' => true
            ])        

        </form>
    </div>

@endsection
