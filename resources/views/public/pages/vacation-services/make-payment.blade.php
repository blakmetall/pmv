@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('MAKE PAYMENT');
    @endphp

    @include('public.pages.partials.main-content-start')

    <form action="{{ route('public.vacation-services.find-booking') }}" method="post">
        @csrf
        <div>
            <div class="form-item form-item-bid form-type-textfield form-group">
                @include('components.form.input', [
                'group' => 'booking',
                'label' => __('ID Booking'),
                'name' => 'booking_id',
                'required' => true,
                'instruction' => __('Let us find your reservation first, please enter your confirmation number
                below.'),
                ])
            </div>
            <button type="submit" class="btn btn-default form-submit" value="{{ __('Find Reservation') }}">
                {{ __('Find Reservation') }}
            </button>
        </div>
    </form>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection

<!-- test comment for github sandbox branch -->
