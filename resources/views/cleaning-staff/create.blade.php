@extends('layouts.horizontal-master')

@section('heading-content')

   @include('components.heading', [
        'label' => __('New'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-staff'),
                'label' => __('Cleaning Staff'),
            ],
        ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('cleaning-staff.store') }}" method="post">
            @csrf
            @include('cleaning-staff.partials.form', ['row' => $cleaning_staff])
        </form>
    </div>

@endsection
