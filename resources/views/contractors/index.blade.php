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
                        @include('partials.page-heading', ['title' => __('Contractors')])

                    </div>

                    <div class="col-md col-4 text-lg-right">
                        <a href="{{ route('contractors.create') }}" class="btn btn-dark ripple m-1" role="button" >
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
    @include('contractors.partials.search')

    <!-- here the data is loaded -->
    @include('contractors.partials.table', [
        'label' => __('Contractors'),
        'rows' => $contractors
    ])


@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
