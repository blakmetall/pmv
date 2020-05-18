@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('View'),
        'breadcrumbs' => [
            [
                'url' => route('agents'),
                'label' => __('Agents'),
            ],
        ],
        'actions' => [
            [
                'label' => __('New'),
                'url' => route('agents.create'),
            ]
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('agents.partials.form', [
                'row' => $agent,
                'disabled' => true
            ])        
        </form>
    </div>
@endsection
