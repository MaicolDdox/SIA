<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo_documento',
        'numero_documento',
        'genero',
        'rh',
        'eps',
        'telefono',
        'tipo_programa',
        'programa_formacion',
        'ficha_programa',
        'apoyos',
        'formato_registro',
        'semillero_name',
        'proyecto_titulo',
        'proyecto_descripccion',
    ];

    // Relación con User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
