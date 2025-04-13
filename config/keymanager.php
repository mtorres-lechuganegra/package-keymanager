<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default data
    |--------------------------------------------------------------------------
    |
    | Datos por defecto para los endpoint's del paquete.
    |
    */
    'default_page' => env('KEY_MANAGER_DEFAULT_PAGE', 1),
    'default_size' => env('KEY_MANAGER_DEFAULT_SIZE', 20),

    /*
    |--------------------------------------------------------------------------
    | User entity
    |--------------------------------------------------------------------------
    |
    | Modelo de Usuario para la gestión de autenticación.
    |
    */
    'user_entity' => [
        'model' => App\Models\User::class,
        'table' => 'users'
    ],
];
