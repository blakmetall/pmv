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
                            'title' => __('View Contractor'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('contractors'),
                                    'label' => __('Contractors'),
                                ],
                            ]
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">
                    
                        <a href="{{ route('contractors.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>


    <!-- form -->
    <form action="" onsubmit="return false;" method="post">

        <div class="container app-container-sm">

            <!-- form fields -->
            @include('contractors.partials.form', [
                'row' => $contractor,
                'disabled' => true
            ])        

        </div>

    </form>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection