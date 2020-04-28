@php
    $renderStepper = !! (isset($renderStepper) && $renderStepper);
    $activeStep = isset($activeStep) && is_numeric($activeStep) ? $activeStep : 1;
@endphp

@if ($renderStepper)
    @include('partials.stepper', [
        'id' => 'properties-stepper',
        'activeStep' => $activeStep,
        'steps' => [
            [
                'label' => 'Step 1',
                'description' => 'step one description',
            ],
            [
                'label' => 'Step 2',
                'description' => 'step two description',
            ],
            [
                'label' => 'Step 3',
                'description' => 'step three description',
            ],
        ]
    ])
@endif