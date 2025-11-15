<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'semillero_id',
        'director_id',
        'nombre',
        'descripcion',
        'fase_actual',
        'fecha_inicio',
        'fecha_fin',
    ];


    // Un proyecto pertenece a un semillero
    public function semillero()
    {
        return $this->belongsTo(Semillero::class, 'semillero_id');
    }

    // Un proyecto tiene un director (usuario)
    public function director()
    {
        return $this->belongsTo(User::class, 'director_id');
    }

    // Un proyecto tiene muchas fases
    public function fases()
    {
        return $this->hasMany(ProjectFase::class);
    }

    public function integrantes()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
            ->withPivot('rol'); // Si quieres acceder al rol del aprendiz en el proyecto
    }

    public function files():HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }


    // Un proyecto puede tener eventos
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    //protected static function booted()
    //{
    //    static::created(function ($project) {
    //        Event::create([
    //            'titulo' => "Proyecto: {$project->nombre}",
    //            'descripcion' => "Descripccion: {$project->descripcion}",
    //            'fecha_inicio' => $project->created_at->format('Y-m-d'),
    //            'fecha_fin' => $project->end_date,
    //            'project_id' => $project->id,
    //        ]);
    //    });

    //    static::deleted(function ($project) {
    //        // Borrar los eventos asociados al proyecto
    //        $project->events()->each(function ($event) {
    //            $event->delete();
    //        });
    //    });
    //}
}
