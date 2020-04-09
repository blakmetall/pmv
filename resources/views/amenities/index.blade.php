@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md col-8">
                        @include('partials.page-heading', [
                            'title' => __('Amenities'),
                            'breadcrumbs' => []
                        ])
                    </div>

                    <div class="col-md col-4 text-lg-right">
                        <a href="{{ route('amenities.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- here the search bar is loaded -->
    @include('amenities.partials.search')

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('amenities.partials.table', [
        'label' => __('Amenities'),
        'rows' => $amenities
    ])

@endsection
