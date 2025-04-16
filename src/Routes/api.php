<?php

use Illuminate\Support\Facades\Route;
use LechugaNegra\KeyManager\Http\Controllers\ApiKeyController;

Route::prefix('api/key')->name('api.key.')->group(function () {
    Route::post('generate/', [ApiKeyController::class, 'generate'])->name('generate'); // Crear nueva API Key
    Route::delete('revoke/{key}', [ApiKeyController::class, 'revoke'])->name('revoke'); // Revocar API Key
});

Route::middleware(['api.key'])->group(function () {
    Route::prefix('api/key')->name('api.key.')->group(function () {
        Route::post('validate/', [ApiKeyController::class, 'validate'])->name('validate'); // Crear nueva API Key
    });
});