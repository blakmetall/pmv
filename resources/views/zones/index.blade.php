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
                            'title' => __('Zones'),
                            'breadcrumbs' => []
                        ])

                    </div>

                    <div class="col-md col-4 text-lg-right">

                        <!-- action buttons goes here -->
                        <a href="{{ route('zones.create') }}" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('New') }}
                        </a>
                        <a href="#" class="btn btn-dark ripple m-1" role="button" >
                            {{ __('Demo Button') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- here the search bar is loaded -->
    @include('zones.search')

    <!-- here the data is loaded -->
    @include('zones.table', [
        'label' => __('Zones'),
        'rows' => $zones
    ])


@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection



{{--@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')

<div class="row">
    <h1> Listado de Zonas </h1>
</div>

<div class="row">
    <a href="{{ route('zones-create') }}" style="padding: 20px; background: lightblue; border-radius: 10px; margin-top: 50px;" > Create New Zones</a>
</div>

@endsection

@section('page-js')

@endsection

--}}



