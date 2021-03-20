@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('contractors-services'),
                'label' => __('Services'),
            ],
        ],
        'actions' => [
            [
                'url' => route('contractors-services'),
                'icon' => 'i-Receipt-4',
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('contractors-services.store') }}" method="post">
            @csrf
            
            @include('contractors-services.partials.form', [
                'row' => $service
            ])        
        </form>
    </div>

@endsection
