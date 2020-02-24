@extends('layouts.horizontal-master')

@section('before-css')
@endsection

@section('main-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md col-8">

                        <!-- title layout heading goes here -->
                        @include('partials.page-heading', [
                            'title' => __('Cities'),
                            'breadcrumbs' => []
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">

                        <!-- action buttons goes here -->
                        <a href="{{ route('cities.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>
                        <a href="#" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('Demo Button') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- here the search bar is loaded -->
    @include('/cities/partials.search')

    <!-- here the data is loaded -->
    @include('/cities/partials.table', [
        'label' => __('Cities'),
        'rows' => $cities
    ])


@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection



