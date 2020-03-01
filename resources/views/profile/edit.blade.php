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
                        @include('partials.page-heading', ['title' => __('Profile')])
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>


    <!-- form -->
    <form action="{{ route('profile.update') }}" method="post">

        <!-- token -->
        @csrf

        <div class="container app-container-sm">

            <!-- form fields -->
            @include('profile.partials.form', [
                'row' => $profile
            ])        

        </div>

    </form>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
