<?php

use Illuminate\Support\Facades\Route;
use LechugaNegra\KeyManager\Http\Controllers\ApiKeyController;

Route::prefix('api/key')->group(function () {
    Route::post('generate/', [ApiKeyController::class, 'generate']); // Crear nueva API Key
    Route::delete('revoke/{key}', [ApiKeyController::class, 'revoke']); // Revocar API Key
});

Route::middleware(['api.key'])->group(function () {
    Route::prefix('api/key')->group(function () {
        Route::post('validate/', [ApiKeyController::class, 'validate']); // Crear nueva API Key
    });
});