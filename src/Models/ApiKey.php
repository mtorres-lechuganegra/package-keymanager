<?php

namespace Lechuganegra\KeyManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiKey extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'key', 'name', 'user_id', 'status',
        'expires_at', 'referer_url'
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(config('keymanager.user_entity.model')::class);
    }
}

// ApiKey::withTrashed()->get(); // Ver eliminados
// $apiKey->restore(); // Restaurar eliminado
// $apiKey->forceDelete(); // Eliminación física
