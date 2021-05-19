<?php

return [

    'roles' => [
        'super' => 1,
        'admin' => 2,
        'property-management' => 3,
        'rentals' => 4,
        'rentals-agent' => 5,
        'operations-manager' => 6,
        'operations-assistant' => 7,
        'accounting' => 8,
        'administrative-assistant' => 9,
        'concierge' => 10,
        'owner' => 11,
        'regular' => 12,
        'human-resources' => 13,
        'cleanings' => 14,
    ],

    'pagination' => [
        'per-page' => 50
    ],

    'operation_types' => [
        'credit' => 1,
        'charge' => 2,
    ],

    'thumbnails' => [
        'small' => [
            'width' => 300,
            'height' => 300,
        ],
        'small-ls' => [
            'width' => 300,
            'height' => 200,
        ],
        'medium' => [
            'width' => 700,
            'height' => 700,
        ],
        'medium-ls' => [
            'width' => 800,
            'height' => 600,
        ],
        'large' => [
            'width' => 1000,
            'height' => 650,
        ],
        'large-ls' => [
            'width' => 1200,
            'height' => 800,
        ],
    ],

    'valid_image_types' => ['jpg', 'jpeg', 'png', 'bmp'],
];
