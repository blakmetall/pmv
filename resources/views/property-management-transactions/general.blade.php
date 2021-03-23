@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Property Management Transactions'),
    ])

    <!-- general pending audits search -->
    @include('property-management-transactions.partials.search-general', ['transationTypesOptionsIds' => $transationTypesOptionsIds])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management-transactions.partials.table', [
        'label' => __('Property Management Transactions'),
        'rows' => $transactions,
        'skipAuditedTable' => true,
        'usePendingAuditPresentation' => true,
    ])

@endsection
