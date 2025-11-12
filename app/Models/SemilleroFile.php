<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SemilleroFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'nombre_original',
        'ruta',
    ];


    //un archivo de semillero pertenece a un semillero
    public function semillero():BelongsTo
    {
        return $this->belongsTo(Semillero::class, 'semillero_id');
    }
}

