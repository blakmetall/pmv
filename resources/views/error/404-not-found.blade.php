@extends('layouts.error-master')

@section('before-css')
@endsection

@section('main-content')

    <div class="not-found-wrap text-center">
        <h1 class="text-60">
            404
        </h1>
        
        <p class="text-36 subheading mb-3">{{ __('Not Found!') }}</p>

        <p class="mb-5  text-muted text-18">
            {{ __('Sorry! The page your are searching doesn\'t exists.') }} <br />
        </p>

        <a class="btn btn-lg btn-primary btn-rounded" href="{{route('dashboard')}}">
            {{ __('Go back to home') }}
        </a>
    </div>

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection

    
    
    
    
    
    
