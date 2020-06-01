@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('property-management-transactions.general')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management-transactions.partials.table', [
        'label' => __('Property Management Transactions'),
        'rows' => $transactions
    ])

@endsection
