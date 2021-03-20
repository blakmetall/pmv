@extends('layouts.horizontal-master')

@section('heading-content')
     @include('components.heading', [
        'label' => __('Roles'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    @include('roles.partials.table', [
        'label' => __('Roles'),
        'rows' => $roles
    ])

@endsection