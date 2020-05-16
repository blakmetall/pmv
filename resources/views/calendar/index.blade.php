@extends('layouts.horizontal-master')

@section('main-content')

    <!-- here the data is loaded -->
    @include('calendar.partials.table', [
        'label' => __('Cleaning Services'),
        'rows' => $cleaning_services
    ])

@endsection
