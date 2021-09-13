@extends('layouts.horizontal-master')

@php
    $fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : '';
    $toDate = isset($_GET['to_date']) ? $_GET['to_date'] : '';
    $searchedLocation = isset($_GET['location']) ? $_GET['location'] : '';
    $url = isset($propertyId) ? route('property-bookings.by-property', [$propertyId]) : route('property-bookings');
    $actions = [];
    if (!isRole('owner')){
        $actions[] = 
            [
                'url' => route('properties.show', [$property->id]),
                'icon' => 'i-Eye font-weight-bold',
            ];
        
        $actions[] = 
            [
                'url' => route('property-images', [$property->id]),
                'icon' => 'i-Old-Camera font-weight-bold',
            ];

        $actions[] = 
            [
                'url' => route('property-bookings.by-property', [$property->id]),
                'icon' => 'i-Calendar-2 font-weight-bold',
            ];

        $actions[] = 
            [
                'url' => route('property-rates', [$property->id]),
                'icon' => 'i-Money-2 font-weight-bold',
            ];

        $actions[] = 
            [
                'url' => route('property-contacts', [$property->id]),
                'icon' => 'i-Administrator font-weight-bold',
            ];

        $actions[] = 
            [
                'url' => route('property-notes', [$property->id]),
                'icon' => 'i-Notepad font-weight-bold',
            ];
    }

    if (!isRole('owner') && $property->is_online){
        $actions[] = 
            [
                'url' => route('public.property-detail', [App::getLocale(), getZone($property->id), $property->translate()->slug]),
                'icon' => 'i-Right font-weight-bold',
            ];
    }

    if (!isRole('owner') && can('edit', 'property-management')){
        $actions[] = 
            [
                'url' => route('property-management', [$property->id]),
                'icon' => 'i-Building font-weight-bold',
            ];
    }
    $actions[] = 
        [
            'url' => route('property-calendar', [$property->id]),
            'icon' => 'i-Calendar-4 font-weight-bold',
        ];
@endphp

@section('heading-content')
    @if (isset($property))
        @if ($property->users->isNotEmpty())
            @php
                $propertyUser = false;
            @endphp

            @foreach ($property->users as $user)
                @if ($user->id == \UserHelper::getCurrentUserID())
                    @php
                        $propertyUser = true;
                    @endphp
                @endif
            @endforeach
        @endif
    @endif

    @include('components.heading', [
        'label' => __('Bookings'),
        'actions' => $actions
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search-bookings', [
        'url' => $url
    ])

    <!-- separator -->
    <div class="mb-4"></div>


@endsection

@section('main-content')
    <!-- here the data is loaded -->
    @include('property-bookings.partials.table', [
        'label' => __('Bookings'),
        'rows' => $bookings
    ])
@endsection
