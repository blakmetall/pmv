@extends('layouts.horizontal-master')

@section('before-css')
@endsection


@section('main-content')

    

    <div class="row justify-content-md-center">
    <div class="card col-7 align-self-center">
        
        <div class="card-body">
            <div class="card-title">
                {{ __('Property Details') }}
            </div>

            <div class="col-md-12">
                <div class="row justify-content-md-end">
                    <a class="col-1" href="{{ route('properties') }}">
                        <span class="btn btn-primary">{{ __('List') }}</span>
                    </a>
                    <a class="col-1" href="#">
                        <span class="btn btn-primary">{{ __('Print') }}</span>
                    </a>
                </div>
            </div>

            <!-- here individual fields are loaded -->
            @include('properties.partials.show-fields', [
                        'row' => $property,
                        'label' => __('ENGLISH'),
                        'lang' => 'en',
                    ])            
                    
        </div>
    </div>
</div>


    

@endsection

@section('page-js')
@endsection

@section('bottom-js')
@endsection
