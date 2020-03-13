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
                        @include('partials.page-heading', ['title' => __('Settings')])
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-4"></div>
    
    <div class="container app-container-sm">
        @include('partials.list-menu', ['menu' => $menu])
    </div>

    



@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
