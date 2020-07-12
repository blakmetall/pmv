@extends('layouts.horizontal-master')

@section('main-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md col-8">

                        <!-- title layout heading goes here -->
                        @include('partials.page-heading', [
                            'title' => __('New Transaction Bulk'),
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

    <div class="container app-container">
        <div class="card">
            <div class="card-body">
                <p>
                    {{ __('Coming Soon') }}...
                </p>
            </div>
        </div>
    </div>

@endsection
