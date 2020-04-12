@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        @include('partials.page-heading', [
                            'title' => __('Cities')
                        ])
                    </div>

                    <div class="col-sm-12 col-md-4 text-md-right app-heading-buttons">
                        <a href="{{ route('cities.create') }}" class="btn btn-dark ripple m-1" role="button" >
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
    @include('cities.partials.search')

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('cities.partials.table', [
        'label' => __('Cities'),
        'rows' => $cities
    ])

@endsection



