@extends('layouts.horizontal-master')

@section('heading-content')

     @include('components.heading', [
        'label' => __('Account'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')
    <div class="container app-container-sm">
        <form action="{{ route('account.update') }}" method="post">
            @csrf
            @include('account.partials.form', ['row' => $user])        
        </form>
    </div>
@endsection
