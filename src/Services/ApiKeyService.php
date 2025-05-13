<?php

namespace LechugaNegra\KeyManager\Services;

use Illuminate\Support\Str;
use LechugaNegra\KeyManager\Models\ApiKey;

class ApiKeyService
{
    /**
     * Verifica si el usuario tiene permiso para una ruta determinada.
     *
     * @param string $apiKey
     * @param string $origin
     * @return bool
     */
    public function validateKey(string $apiKey, string $origin = ''): bool
    {
        // Buscar la API Key en la base de datos
        $key = ApiKey::where('key', $apiKey)->where('status', 'active')->first();

        if (!$key) {
            return false;
        }

        // Validar la URL referida solo si existe en la API Key
        if ($key->referer_url) {
            // Validar valor de origen
            if (!$origin) {
                return false;
            }

            // Convertir a dominio limpio (extraer solo dominio principal)
            $parsedOrigin = parse_url($origin, PHP_URL_HOST);

            // Validar que el dominio coincida con el registrado
            if ($parsedOrigin !== $key->referer_url) {
                return false;
            }
        }

        return true;
    }

    /**
     * Genera una nueva clave API para el usuario.
     *
     * @param array $data
     * @return string|null
     */
    public function generateApiKey(array $data)
    {
        // Verificar que el usuario exista
        $user = config('keymanager.user_entity.model')::find($data['user_id']);

        // Si el usuario no existe, retornamos null
        if (!$user) {
            return null;
        }

        // Crear la API key
        $key = Str::random(32);

        // Asignar valores por defecto
        $status = $data['status'] ?? 'active';
        $expiresAt = $data['expires_at'] ?? null;
        $refererUrl = $data['referer_url'] ?? null;
        $name = $data['name'];

        // Almacenar la API key en la base de datos
        ApiKey::create([
            'user_id' => $data['user_id'],
            'key' => $key,
            'name' => $name,
            'referer_url' => $refererUrl,
            'status' => $status,
            'expires_at' => $expiresAt,
        ]);

        return $key;
    }

    /**
     * Revoca una clave API existente.
     *
     * @param string $key
     * @return void
     */
    public function revokeApiKey(string $key)
    {
        // Buscar la clave API en la base de datos
        $apiKey = ApiKey::where('key', $key)->first();
    
        // Si la clave no existe, retornar falso
        if (!$apiKey) {
            return false;
        }
    
        // Si existe, proceder a revocarla
        $apiKey->delete();
    
        return true;
    }
}
