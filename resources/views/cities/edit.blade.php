@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        @include('partials.page-heading', [
                            'title' => __('Edit'),
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
        <form action="{{ route('cities.update', $city->id) ?? '' }}" method="post">
            @csrf

            <!-- form fields -->
            @include('cities.partials.form', [
                'row' => $city
            ])
        </form>
    </div>

@endsection