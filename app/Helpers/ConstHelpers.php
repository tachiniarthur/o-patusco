<?php

namespace App\Helpers;

class ConstHelpers
{
    public const OPTIONS_ANIMALS_TYPE = [
        [
            'id' => 'dog',
            'name' => 'Dog'
        ],
        [
            'id' => 'cat',
            'name' => 'Cat'
        ],
        [
            'id' => 'bird',
            'name' => 'Bird'
        ],
        [
            'id' => 'fish',
            'name' => 'Fish'
        ],
        [
            'id' => 'reptile',
            'name' => 'Reptile'
        ],
        [
            'id' => 'other',
            'name' => 'Other'
        ],
    ];

    public const OPTIONS_ANIMALS_SIZES = [
        [
            'id' => 'small',
            'name' => 'Small'
        ],
        [
            'id' => 'medium',
            'name' => 'Medium'
        ],
        [
            'id' => 'large',
            'name' => 'Large'
        ],
    ];

    public const OPTIONS_ROLES = [
        [
            'id' => 'admin',
            'name' => 'Admin'
        ],
        [
            'id' => 'receptionist',
            'name' => 'Receptionist'
        ],
        [
            'id' => 'doctor',
            'name' => 'Doctor'
        ],
        [
            'id' => 'client',
            'name' => 'Client'
        ],
    ];
}