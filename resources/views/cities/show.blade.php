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
                            'title' => __('View City'),
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
                        <a href="{{ route('cities.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>

    
    <!-- form  -->
    <div class="container app-container">
        
        <!-- form -->
        <form action="" onsubmit="return false;" method="post">

            <!-- form fields -->
            @include('cities.partials.form', [
                'row' => $city,
                'disabled' => true
            ])

        </form>

    </div>


@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection