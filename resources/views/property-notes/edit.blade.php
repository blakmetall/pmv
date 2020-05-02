@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('property-notes', [$property->id]),
                'label' => __('Notes'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('property-notes.create', [$property->id]),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('property-notes.update', [$property->id, $note->id]) }}" method="post">
            @csrf
            @include('property-notes.partials.form', [
                'row' => $note
            ])        
        </form>
    </div>

@endsection
