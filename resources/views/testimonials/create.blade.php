@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('New'),
    'breadcrumbs' => [
    [
    'url' => route('testimonials'),
    'label' => __('Testimonials'),
    ],
    ],
    'actions' => [
    [
    'url' => route('testimonials'),
    'icon' => 'i-Receipt-4',
    ],
    ]
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')


    <div class="container app-container-sm">
        <form action="{{ route('testimonials.store') }}" method="post">
            @csrf

            @include('testimonials.partials.form', [
            'row' => $testimonial,
            ])
        </form>
    </div>

@endsection
