@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Cleaning Options'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('cleaning-options.create'),
                'icon' => 'i-Add',
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('cleaning-options')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('cleaning-options.partials.table', [
        'label' => __('Cleaning Options'),
        'rows' => $cleaning_options
    ])

@endsection
