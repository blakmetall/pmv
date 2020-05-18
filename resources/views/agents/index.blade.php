@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Agents'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('agents.create')
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('agents')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('agents.partials.table', [
        'label' => __('Agents'),
        'rows' => $agents
    ])

@endsection