@extends('layouts.horizontal-master')

@section('before-css')
@endsection

@section('main-content')

    <!-- here individual fields are loaded -->
    @include('properties.partials.show-fields', [
                'row' => $property,
                'title' => __('Property Details')
            ])

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
