@extends('layouts.horizontal-master')

@section('heading-content')
    @include('components.heading', [
    'label' => __('Balances'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('property-management-balances.partials.search-general', [
    'url' => route('property-management-balances.general'),
    'cities' => $cities
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    @include('property-management-balances.partials.table', [
    'label' => __('Balances'),
    'pm_items' => $pm_items,
    'totalBalances' => $totalBalances
    ])

@endsection
