@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('agents'),
                'label' => __('Agents'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('agents.store') }}" method="post">
            @csrf

            <!-- form fields -->
            @include('agents.partials.form', [
                'row' => $agent,
                'roles' => $roles,
            ])        
        </form>
    </div>
@endsection