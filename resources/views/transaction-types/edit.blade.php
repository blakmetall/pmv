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
                            'title' => __('Edit Transaction Types'),
                            'breadcrumbs' => [
                                [
                                    'url' => route('transaction-types'),
                                    'label' => __('Transaction Types'),
                                ],
                            ]
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">

                        <!-- action buttons goes here -->
                        <a href="{{ route('transaction-types.create') }}" class="btn btn-dark ripple m-1" role="button" >
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
                {{ $transaction_type }}
                <!-- form -->
                <form action="" method="post">
                <!-- token -->
                @csrf

                <!-- form fields -->
                    @include('transaction-types.form-fields', [
                        'row' => $transaction_type,
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
