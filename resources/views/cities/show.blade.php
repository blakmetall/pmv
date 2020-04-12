@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        @include('partials.page-heading', [
                            'title' => __('View'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('cities'),
                                    'label' => __('City'),
                                ],
                            ]
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
    <div class="mb-4"></div>

@endsection
    
@section('main-content')

    <div class="container app-container">
        <form action="" onsubmit="return false;" method="post">

            <!-- form fields -->
            @include('cities.partials.form', [
                'row' => $city,
                'disabled' => true
            ])

        </form>
    </div>

@endsection
