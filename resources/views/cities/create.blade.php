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
                            'title' => __('Create City'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('cities'),
                                    'label' => __('City'),
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
                <form action="{{ route('cities.store') }}" method="post">

                    <!-- token -->
                @csrf

                <!-- form fields -->
                    @include('cities.partials.form', [
                        'row' => $city
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
