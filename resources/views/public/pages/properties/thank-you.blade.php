@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = 'Thank You';
    @endphp

    @include('public.pages.partials.main-content-start')

    Thank you for your reservation, your REQUEST has been received with Confirmation <strong>{{ $booking->id }}</strong>,
    we will verify availability and reply to you within 1 business day, after the reservation has been approved we require
    payment to guarantee the booking.<br><br>

    The initial deposit is due within 5 business days from the date of the booking accordingly to the following conditions:
    <br><br>
    • If the arrival date is more than 30 days: a 50% deposit is required at confirmation of the booking and the remaining
    balance 30 days before the arrival date.<br>
    • If the arrival date is within 30 days: 100% payment is required at confirmation of the booking.<br><br>

    A copy of the reservation details has been sent to {{ $booking->email }}.

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
