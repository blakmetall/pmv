@extends('layouts.horizontal-master')

@section('heading-content')
    @include('components.heading', [
        'label' => __('Property Management Balances'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-management-balances.general')
    ])

@endsection

@section('main-content')

    @include('property-management-balances.partials.table', [
        'label' => __('Balances'),
        'pm_items' => $pm_items
    ])

@endsection
