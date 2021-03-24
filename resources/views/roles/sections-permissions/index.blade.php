@extends('layouts.horizontal-master')

@section('heading-content')
     @include('components.heading', [
        'label' => __('Role Permissions'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="breadcrumb">
        <h5>Role Name</h5>
    </div>

    @include('roles.sections-permissions.partials.table', [
        'label' => __('Roles'),
        'rows' => $roles
    ])

@endsection