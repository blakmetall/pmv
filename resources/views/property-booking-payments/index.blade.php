@extends('layouts.horizontal-master')

@section('heading-content')
    @php
        foreach ($booking->property->management as $pm) {
            if (!$pm->is_finished) {
                $url = route('property-management-transactions.create', $pm->id);
                break;
            }
        }

        $actions = [
            [
                'label' => __('Add Payment'),
                'url' => route('property-booking-payments.create', $booking->id),
                'icon' => 'i-Add',
            ],
            [
                'label' => __('Add PM Credit'),
                'url' => $url,
                'icon' => 'i-Add',
            ]
        ];
    @endphp

    @include('components.heading', [
        'label' => __('Payments'),
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-booking-payments.partials.table', [
        'label' => __('Payments'),
        'rows' => $payments
    ])

@endsection
