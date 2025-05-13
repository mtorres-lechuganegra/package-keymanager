<?php

namespace LechugaNegra\KeyManager\Providers;

use Illuminate\Support\ServiceProvider;
use LechugaNegra\KeyManager\Middleware\ValidateKeyMiddleware;

class KeyManagerProvider extends ServiceProvider
{
    /**
     * Registrar servicios del paquete, incluyendo configuración.
     *
     * @return void
     */
    public function register()
    {
        // Registrar archivo de configuración principal
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/keymanager.php',
            'keymanager'
        );
    }

    /**
     * Realizar las configuraciones necesarias.
     *
     * @return void
     */
    public function boot()
    {
        // Cargar configuración predeterminada desde el paquete
        $this->publishes([
            __DIR__ . '/../../config/keymanager.php' => config_path('keymanager.php'),
        ], 'keymanager-config');

        // Registrar el middleware en el Kernel de la aplicación
        $this->app['router']->aliasMiddleware('api.key', ValidateKeyMiddleware::class);

        // Cargar rutas de api.php
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
    }
}
