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
                    <!-- flash messages -->
                    <form action="{{ route('public.find-booking') }}" method="post">
                    @csrf
                        {{ __('MAKE PAYMENT') }}

                        <hr>
                        <!-- booking_id -->
                        @include('components.form.input', [
                            'group' => 'booking',
                            'label' => __('ID Booking'),
                            'name' => 'booking_id',
                            'required' => true,
                            'instruction' =>  __('Let us find your reservation first, please enter your confirmation number below.'),
                        ])

                        <!-- form actions -->
                        <button type="submit" class="btn  btn-primary m-1">
                                {{ __('Find Reservation') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- test comment for github sandbox branch -->
