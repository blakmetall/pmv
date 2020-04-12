@extends('layouts.horizontal-master')

@section('heading-content')

    <!-- heading -->
    <div class="container app-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-8">
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
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container">
        <form action="{{ route('cities.store') }}" method="post">
            @csrf

            @include('cities.partials.form', [
                'row' => $city
            ])
        </form>
    </div>

@endsection