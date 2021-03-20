@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', [
    'label' => __('Edit'),
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
    [
    'label' => __('New'),
    'url' => route('testimonials.create'),
    'icon' => 'i-Add',
    ]
    ]
    ])

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="" onsubmit="return false;" method="post">
            @include('testimonials.partials.form', [
            'row' => $testimonial,
            'disabled' => true
            ])
        </form>
    </div>

@endsection
