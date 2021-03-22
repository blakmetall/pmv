
@extends('layouts.auth-master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <div class="card text-center">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            Palmera Vacations
                        </div>
                        <div class="col-md-6 text-right">
                            @include('partials.language-switcher')
                        </div>
                    </div>
                </div>

                <div class="mb-4 pt-3">
                    <a href="/login">{{ __('Login') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page-css')
