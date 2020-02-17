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
                            'title' => __('Create User'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('users'),
                                    'label' => __('Users'),
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




    <!-- form -->
    <form action="{{ route('users.store') }}" method="post">

        <!-- token -->
        @csrf

        <div class="container app-container-sm">

            <!-- form fields -->
            @include('users.partials.form', [
                'row' => $user
            ])        

        </div>

    </form>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
