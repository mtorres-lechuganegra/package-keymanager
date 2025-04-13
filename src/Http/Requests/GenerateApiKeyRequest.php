<?php

namespace LechugaNegra\KeyManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateApiKeyRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Puedes agregar lógica de autorización más adelante
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', // Usuario debe existir
            'name' => 'required|string|max:255', // Nombre obligatorio
            'referer_url' => 'nullable|url|max:255', // URL válida obligatoria
            'status' => 'nullable|in:active,inactive,revoked,expired', // Enum con valores válidos
            'expires_at' => 'nullable|date|after:today', // Fecha opcional, debe ser futura
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'name.required' => 'El nombre es obligatorio.',
            'referer_url.url' => 'Debe ser una URL válida.',
            'status.in' => 'El estado debe ser: active, inactive, revoked o expired.',
            'expires_at.date' => 'La fecha de expiración debe ser válida.',
            'expires_at.after' => 'La fecha de expiración debe ser en el futuro.',
        ];
    }
}
