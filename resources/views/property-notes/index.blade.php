@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Notes'),
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-notes.create', [$property->id])
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-notes', [$property->id])
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-notes.partials.table', [
        'label' => __('Notes'),
        'rows' => $notes
    ])

@endsection