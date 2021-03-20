@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
        'label' => __('Directory'),
    ])

    <!-- separator -->
    <div class="mb-4"></div>

    @include('components.search', [
        'url' => route('human-resources.directory')
    ])

@endsection

@section('main-content')

    <!-- here the data is loaded -->
    @include('human-resources.partials.table-directory', [
        'label' => __('Directory'),
        'rows' => $human_resources
    ])

@endsection
