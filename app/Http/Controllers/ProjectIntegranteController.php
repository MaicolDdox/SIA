<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class ProjectIntegranteController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $q = trim($request->input('q', ''));

        $query = Project::with(['integrantes', 'director', 'semillero']);

        // Modificación: agregar instructor_integrado junto con aprendiz_integrado
        if ($user->hasRole(['aprendiz_integrado', 'instructor_integrado'])) {
            $query->whereHas('integrantes', function ($sub) use ($user) {
                $sub->where('user_id', $user->id);
            });
        } elseif ($user->hasRole('lider_semilleros')) {
            $query->where('director_id', $user->id);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nombre', 'like', "%{$q}%")
                    ->orWhereHas('director', fn($d) => $d->where('name', 'like', "%{$q}%"))
                    ->orWhereHas('semillero', fn($s) => $s->where('titulo', 'like', "%{$q}%"))
                    ->orWhereHas('integrantes', fn($i) => $i->where('name', 'like', "%{$q}%"));
            });
        }

        $projects = $query->latest('created_at')
            ->paginate(5)
            ->appends(['q' => $q]);

        return view('container.project_integrantes.index', compact('projects', 'q'));
    }


    public function create()
    {
        // Traemos los proyectos del director actual
        $projects = Project::where('director_id', auth()->id())->get();

        // Modificación: traer usuarios con ambos roles
        $integrantes = User::role(['aprendiz_integrado', 'instructor_integrado'])
            ->with('roles') // Cargar roles para mostrar en la vista
            ->get();

        return view('container.project_integrantes.create', compact('projects', 'integrantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'integrantes'  => 'required|array',
            'integrantes.*' => 'exists:users,id',
        ]);

        $project = Project::findOrFail($request->project_id);

        // Recorremos los integrantes seleccionados
        foreach ($request->integrantes as $integranteId) {
            $integrante = User::findOrFail($integranteId);

            // Verificamos si el integrante ya está en otro proyecto
            $proyectoExistente = DB::table('project_user')
                ->where('user_id', $integranteId)
                ->where('project_id', '!=', $project->id)
                ->first();

            if ($proyectoExistente) {
                return back()->withInput()
                    ->withErrors([
                        'integrantes' => "El usuario {$integrante->name} ya está asociado a otro proyecto."
                    ]);
            }

            // Determinar el rol del integrante
            $rol = null;
            if ($integrante->hasRole('aprendiz_integrado')) {
                $rol = Role::where('name', 'aprendiz_integrado')->first();
            } elseif ($integrante->hasRole('instructor_integrado')) {
                $rol = Role::where('name', 'instructor_integrado')->first();
            }

            if (!$rol) {
                return back()->withErrors([
                    'integrantes' => "El usuario {$integrante->name} no tiene un rol válido para integrarse al proyecto."
                ]);
            }

            // Asociamos el integrante al proyecto con su rol correspondiente
            $project->integrantes()->syncWithoutDetaching([
                $integranteId => ['rol' => $rol->id]
            ]);
        }

        return redirect()->route('project_integrantes.index', $project->id)
            ->with('success', 'Integrantes asociados correctamente al proyecto.');
    }

    public function destroy($projectId, $integranteId)
    {
        $project = Project::findOrFail($projectId);
        // Remueve la relación del integrante con el proyecto
        $project->integrantes()->detach($integranteId);

        return redirect()->back()->with('success', 'Integrante eliminado del proyecto correctamente.');
    }
}
