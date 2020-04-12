@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-options'),
                'label' => __('Cleaning Options'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('cleaning-options.store') }}" method="post">
            @csrf
            
            @include('cleaning-options.partials.form', [
                'row' => $cleaning_option
            ])        
        </form>
    </div>

@endsection
