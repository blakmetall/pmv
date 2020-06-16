@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management-transactions.partials.table', [
        'label' => __('Property Management Transactions'),
        'rows' => $transactions,
        'skipAuditedTable' => true,
    ])

@endsection
