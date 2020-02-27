@extends('layouts.horizontal-master')

@section('before-css')
@endsection

@section('main-content')

    <!-- heading -->
    <div class="container app-container-sm">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md col-8">

                        <!-- title layout heading goes here -->
                        @include('partials.page-heading', [
                            'title' => __('Edit property'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('properties'),
                                    'label' => __('properties'),
                                ],
                            ]
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">

                        <!-- action buttons goes here -->
                        <a href="{{ route('properties.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>


    <!-- form -->
    <form action="{{ route('properties.update', [$property->id]) }}" method="post">

        <!-- token -->
        @csrf

        <div class="container app-container-sm">

            <!-- form fields -->
            @include('properties.partials.form', [
                'row' => $property
            ])        

        </div>

    </form>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
