@extends('layouts.horizontal-master')

@section('heading-content')
     @include('components.heading', [
        'label' => __('Profile'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @include('profile.partials.form', [
                'row' => $profile
            ])        
        </form>
    </div>

@endsection

