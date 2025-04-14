<?php

namespace LechugaNegra\KeyManager\Http\Controllers;

use App\Http\Controllers\Controller;
use LechugaNegra\KeyManager\Http\Requests\GenerateApiKeyRequest;
use LechugaNegra\KeyManager\Services\ApiKeyService;

class ApiKeyController extends Controller
{
    protected $keyService;

    public function __construct(ApiKeyService $keyService)
    {
        $this->keyService = $keyService;
    }

    /**
     * Genera una nueva clave API.
     *
     * @param GenerateApiKeyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(GenerateApiKeyRequest $request)
    {
        // Llamar al servicio para generar la clave
        $apiKey = $this->keyService->generateApiKey($request->input());

        // Si no se pudo generar
        if (!$apiKey) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Si la clave fue generada con éxito
        return response()->json([
            'message' => 'API key generated successfully',
            'api_key' => $apiKey,
        ], 201);
    }

    /**
     * Valida la clave API.
     *
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function validate()
    {
        return response()->json(['validate' => true], 404);
    }

    /**
     * Revoca la clave API.
     *
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function revoke($key)
    {
        // Llamar al servicio para revocar la clave
        $isRevoked = $this->keyService->revokeApiKey($key);

        // Si no se pudo revocar (clave no encontrada)
        if (!$isRevoked) {
            return response()->json(['error' => 'API key not found'], 404);
        }
    
        // Si la clave fue revocada con éxito
        return response()->json(['message' => 'API key revoked successfully']);
    }
}
