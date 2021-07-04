@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md col-8">

                        <!-- title layout heading goes here -->
                        @include('partials.page-heading', [
                            'title' => __('Search Results'),
                            'breadcrumbs' => []
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">
                        <!-- action buttons goes here -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    @if($showProperties && $_current_role->isAllowed('properties', 'index'))
        <h5>{{ __('Properties') }}</h5>

        <!-- properties table content -->
        @include('properties.partials.table', [
            'label' => __('Properties'),
            'rows' => $properties
        ])

        <div class="pt-2"></div>
        <hr>
        <div class="pt-4"></div>
    @endif

    @if($showTransactions && $_current_role->isAllowed('property-management', 'index'))
        <h5>{{ __('Transactions') }}</h5>

        <!-- properties table content -->
        @include('property-management-transactions.partials.table', [
            'label' => __('Transactions'),
            'rows' => $transactions,
            'useGeneralSearchPresentation' => true,
        ])

        <div class="pt-2"></div>
        <hr>
        <div class="pt-4"></div>
    @endif

    @if($showBookings && $_current_role->isAllowed('property-bookings', 'index'))
        <h5>{{ __('Bookings') }}</h5>

        <!-- properties table content -->
        @include('property-bookings.partials.table', [
            'label' => __('Bookings'),
            'rows' => $bookings,
        ])
    @endif

@endsection