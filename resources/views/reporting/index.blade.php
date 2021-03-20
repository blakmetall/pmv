@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Reporting'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    {{-- @include('components.search', [
        'url' => route('reporting')
    ]) --}}

@endsection

@section('main-content')

    <div class="container app-container">
        <div class="card">
            <div class="card-body">
                <p>
            {{ __('Coming Soon') }}...
                </p>
            </div>
        </div>
    </div>

@endsection