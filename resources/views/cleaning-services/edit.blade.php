@extends('layouts.horizontal-master')

@section('heading-content')

    @php 
        $actions = [
            [
                'url' => route('cleaning-services'),
                'icon' => 'i-Receipt-4',
            ],
        ];

        if(!isRole('owner') && !isRole('contact')) {
            $actions = array_merge($actions, [
                [
                    'label' => __('New'),
                    'url' => route('cleaning-services.create'),
                    'icon' => 'i-Add',
                ]
            ]);
        }
    @endphp

    @include('components.heading', [
        'label' => __('Edit'),
        'breadcrumbs' => [
            [
                'url' => route('cleaning-services'),
                'label' => __('Cleaning Services'),
            ],
        ],
        'actions' => $actions,
    ])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <div class="container app-container-sm">
        <form action="{{ route('cleaning-services.update', [$cleaning_service->id]) }}" method="post">
            @csrf
            @include('cleaning-services.partials.form', [
                'row' => $cleaning_service
            ])
        </form>
    </div>

@endsection
