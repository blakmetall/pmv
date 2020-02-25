@extends('layouts.horizontal-master')

@section('before-css')
@endsection


@section('main-content')

    

    <div class="row justify-content-md-center">
    <div class="card col-7 align-self-center">

         <div class="col-md col-8">

                <!-- title layout heading goes here -->
                @include('partials.page-heading', [
                    'title' => __('Properties Details'),
                    'breadcrumbs' => []
                ])

            </div>
        
        <div class="card-body">
           

            
            <div class="col-md-12">
                <div class="row justify-content-md-end">
                    <!-- action buttons goes here -->
                    <a href="{{ route('properties') }}" class="btn btn-dark ripple m-1" role="button" >
                        {{ __('Back') }}
                    </a>
                    <a href="#" class="btn btn-dark ripple m-1" role="button" >
                        {{ __('Print') }}
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
