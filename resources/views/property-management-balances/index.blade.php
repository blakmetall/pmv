@extends('layouts.horizontal-master')

@section('heading-content')
    @include('components.heading', [
    'label' => __('Property Management Balances'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('properties.partials.info', [
    'propertyID' => $pm->property->id,
    'property' => $pm->property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
    'url' => route('property-management-balances', [$pm->id])
    ])

@endsection

@section('main-content')

    @include('property-management-balances.partials.table', [
    'label' => __('Balance'),
    'pm_items' => $pm_items,
    'totalBalances' => $totalBalances,
    ])

@endsection
