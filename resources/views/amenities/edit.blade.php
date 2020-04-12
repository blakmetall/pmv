@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container-sm">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        @include('partials.page-heading', [
                            'title' => __('Edit'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('amenities'),
                                    'label' => __('Amenities'),
                                ],
                            ]
                        ])
                    </div>

                    <div class="col-sm-12 col-md-4 text-md-right app-heading-buttons">
                        <a href="{{ route('amenities.create') }}" class="btn btn-dark ripple m-1" role="button" >
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

    <form action="{{ route('amenities.update', [$amenity->id]) }}" method="post">
        @csrf
        <div class="container app-container-sm">

            <!-- form fields -->
            @include('amenities.partials.form', [
                'row' => $amenity
            ])        

        </div>
    </form>

@endsection
