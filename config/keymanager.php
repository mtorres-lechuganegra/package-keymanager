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
    'max_size' => env('KEY_MANAGER_MAX_SIZE', 100),
    'default_skip' => env('KEY_MANAGER_DEFAULT_SKIP', 0),
    'default_take' => env('KEY_MANAGER_DEFAULT_TAKE', 20),
    'max_take' => env('KEY_MANAGER_MAX_TAKE', 100),

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
