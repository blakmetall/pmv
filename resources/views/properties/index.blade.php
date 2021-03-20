@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [];
        if(!isRole('owner')) {
            $actions = [
                [
                    'label' => __('New'),
                    'url' => route('properties.create'),
                    'icon' => 'i-Add',
                ]
            ];
        }
    @endphp

    @include('components.heading', [
        'label' => __('Properties'),
        'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('properties')
    ])


@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('properties.partials.table', [
        'label' => __('Properties'),
        'rows' => $properties
    ])

@endsection