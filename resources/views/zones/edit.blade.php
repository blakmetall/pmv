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
                            'title' => __('Edit Zone'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('zones'),
                                    'label' => __('Zones'),
                                ],
                            ]
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">

                        <!-- action buttons goes here -->
                        <a href="{{ route('zones.create') }}" class="btn btn-dark ripple m-1" role="button" >
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
        <div class="card">
            <div class="card-body">

                <!-- form -->
                <form action="{{ route('zones.update', [$zone->id]) }}" method="post">

                    <!-- token -->
                @csrf

                <!-- form fields -->
                    @include('zones.form-fields', [
                        'row' => $zone
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
