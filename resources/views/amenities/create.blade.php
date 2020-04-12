@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container-sm">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        @include('partials.page-heading', [
                            'title' => __('Create'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('amenities'),
                                    'label' => __('Amenities'),
                                ],
                            ]
                        ])
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('amenities.store') }}" method="post">
            @csrf
            
            @include('amenities.partials.form', [
                'row' => $amenity
            ])        
        </form>
    </div>

@endsection
