@extends('layouts.auth-master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            @include('partials.language-switcher')
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <p>
                        {{ __('Welcome to Palmera Vacations, this site is under maintenance...') }}

                        <hr>

                        <a href="{{ route('dashboard') }}">
                            {{ __('Go to new dashboard') }}
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- test comment for github sandbox branch -->
