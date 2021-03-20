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

    @if($showProperties)
        <!-- properties table content -->
        @include('properties.partials.table', [
            'label' => __('Properties'),
            'rows' => $properties
        ])

        <div class="pt-4"></div>
        <hr>
    @endif

    @if($showTransactions)
        <!-- properties table content -->
        @include('property-management-transactions.partials.table', [
            'label' => __('Transactions'),
            'rows' => $transactions,
            'useGeneralSearchPresentation' => true,
        ])
    @endif

@endsection