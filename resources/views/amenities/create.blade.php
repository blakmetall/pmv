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
                            'title' => __('Create Amenity'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('amenities'),
                                    'label' => __('Amenities'),
                                ],
                            ]
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">
                        <!-- action buttons goes here -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>



    <!-- form  -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <!-- form -->
                <form action="{{ route('amenities.store') }}" method="post">

                    <!-- token -->
                    @csrf

                    <!-- form fields -->
                    @include('amenities.form-fields', [
                        'row' => $amenity
                    ])

                </form>

            </div>
        </div>
    </div>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
