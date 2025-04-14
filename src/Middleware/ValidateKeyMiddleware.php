<?php

namespace LechugaNegra\KeyManager\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use LechugaNegra\KeyManager\Services\ApiKeyService;

class ValidateKeyMiddleware
{
    protected $keyService;

    public function __construct(ApiKeyService $keyService)
    {
        $this->keyService = $keyService;
    }

    public function handle(Request $request, Closure $next)
    {
        // Obtener API Key del header
        $apiKey = trim($request->header('X-API-KEY'));

        if (!$apiKey) {
            return response()->json(['error' => 'API Key is required'], Response::HTTP_UNAUTHORIZED);
        }

        // Obtener el origen de la petición (dominio de donde se hace la solicitud)
        $origin = $request->headers->get('origin') ?? $request->headers->get('referer') ?? '';

        // Verificar si la llave es válida
        if (!$this->keyService->validateKey($apiKey, $origin)) {
            return response()->json(['error' => 'Invalid key, you do not have access'], 403);
        }

        return $next($request);
    }
}
