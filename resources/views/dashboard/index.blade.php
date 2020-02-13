@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumb">
        <h1>{{ trans('messages.welcome') }}</h1>

        <ul>
            <li><a href="">Starter</a></li>
            <li>Blank Page</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>


    <!-- Content Goes Here-->

@endsection

@section('page-js')

@endsection
