@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')
    <div class="row"><h1>{{ trans('messages.welcome-properties') }}</h1></div>

    {{ $session_data }}
@endsection
@section('page-js')
@endsection


