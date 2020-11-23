@php
    $lang = LanguageHelper::current();
@endphp
@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Email'),
        'breadcrumbs' => [
            [
                'url' => route('property-booking-payments.edit', [$payment->id]),
                'label' => __('Payment'),
            ],
        ],
    ])

    <!-- separator -->
    <div class="mb-4"></div>
    @include('properties.partials.info', [
        'propertyID' => $property->id,
        'property' => $property
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('property-booking-payments.send-email', [$payment->id]) }}" method="post">
            @csrf
            @include('property-booking-payments.partials.form-email', [
                'row' => $payment,
                'property' => $property,
            ])
        </form>
    </div>

@endsection
