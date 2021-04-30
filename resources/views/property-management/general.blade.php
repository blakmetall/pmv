@extends('layouts.horizontal-master')

@section('heading-content')
    @include('components.heading', [
        'label' => __('Property Management'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('property-management.partials.search-general', [
        'url' => route('property-management.general'),
        'cities' => $cities
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('property-management.partials.table', [
        'label' => __('Property Management'),
        'rows' => $pm_items,
        'active' => $active,
        'total' => $total
        'finished' => $finished,
    ])

@endsection
