@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Settings'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- list -->   
    <div class="container app-container-sm"> 
        @include('components.list', [
            'items' => $menu
        ])
    </div>
    
@endsection

@section('main-content')

@endsection