<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Semillero;
use App\Models\ProjectFase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $q = trim($request->input('q', ''));

        $query = Project::with(['semillero', 'director']);

        if ($user->hasRole('lider_semilleros')) {
            $query->where('director_id', $user->id);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nombre', 'like', "%{$q}%")
                    ->orWhere('fase_actual', 'like', "%{$q}%")
                    ->orWhereHas('semillero', function ($qSem) use ($q) {
                        $qSem->where('titulo', 'like', "%{$q}%");
                    })
                    ->orWhereHas('director', function ($qDir) use ($q) {
                        $qDir->where('name', 'like', "%{$q}%");
                    });
            });
        }

        $projects = $query->latest('created_at')
            ->paginate(10)
            ->appends(['q' => $q]);

        return view('container.projects.index', compact('projects', 'q'));
    }



    public function create()
    {
        $semilleros = Semillero::all();
        return view('container.projects.create', compact('semilleros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:projects,nombre',
            'descripcion' => 'nullable|string',
            'semillero_id' => 'required|exists:semilleros,id',
            'fecha_fin' => 'required|date|after:today',
        ]);

        // Crear el proyecto con fase inicial = formulacion
        $project = Project::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'semillero_id' => $request->semillero_id,
            'director_id' => auth()->id(),
            'fase_actual' => 'formulacion',
            'fecha_inicio' => now(),
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Crear el registro de la primera fase en la tabla project_fases
        $project->fases()->create([
            'nombre' => 'formulacion',
            'fecha_inicio' => now(),
            'descripcion' => 'Inicio del proyecto en fase de formulación',
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado y fase inicial registrada exitosamente.');
    }


    public function show(Project $project)
    {
        $project->load(['fases', 'integrantes', 'semillero', 'director', 'files']);
        return view('container.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $semilleros = Semillero::all();
        return view('container.projects.edit', compact('project', 'semilleros'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:projects,nombre,' . $project->id,
            'descripcion' => 'nullable|string',
            'fecha_fin' => 'nullable|date|after_or_equal:' . $project->fecha_inicio,
        ]);

        $project->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    public function advance(Request $request, Project $project)
    {
        $request->validate([
            'fecha_fin' => 'required|date|after_or_equal:' . $project->fecha_inicio,
            'descripcion' => 'nullable|string|max:500',
        ]);

        $fases = ['formulacion', 'ejecucion', 'finalizacion y divulgacion'];
        $faseActualIndex = array_search($project->fase_actual, $fases);

        if ($faseActualIndex === false) {
            return redirect()->back()->with('error', 'Fase actual inválida.');
        }

        // Cerrar la fase actual
        $faseActual = $project->fases()->where('nombre', $project->fase_actual)->latest()->first();

        if ($faseActual && !$faseActual->fecha_fin) {
            $faseActual->update([
                'fecha_fin'   => $request->fecha_fin,
                'descripcion' => $request->descripcion, // se guarda la info del cierre
            ]);
        }

        // Avanzar si no es la última
        if ($faseActualIndex < count($fases) - 1) {
            $nuevaFase = $fases[$faseActualIndex + 1];

            $project->update(['fase_actual' => $nuevaFase]);

            $project->fases()->create([
                'nombre'       => $nuevaFase,
                'fecha_inicio' => now(),
                'descripcion'  => null, // 👈 importante: empieza vacía
            ]);

            return redirect()->route('projects.show', $project)
                ->with('success', 'Proyecto avanzado a la fase: ' . $nuevaFase);
        }

        // Si ya es la última fase, cerrar proyecto
        $project->update([
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto finalizado en la fase: ' . $project->fase_actual);
    }


    // Reporte
    public function report()
    {
        $projects = Project::with(['fases', 'semillero'])->get();
        return view('projects.report', compact('projects'));
    }

    public function showFase(Project $project, ProjectFase $fase)
    {
        // asegurar que la fase pertenezca al proyecto
        if ($fase->project_id !== $project->id) {
            abort(404);
        }

        return view('container.projects.fases.show', compact('project', 'fase'));
    }

    /**
     * Subir o reemplazar el documento de una fase
     */
    public function storeFaseDocumento(Request $request, Project $project, ProjectFase $fase)
    {
        // Verifica que la fase pertenece al proyecto
        if ($fase->project_id !== $project->id) {
            abort(404);
        }

        $request->validate([
            'documento' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:2048', // 2 MB (ajusta a lo que necesites)
            ],
        ]);

        // Si ya hay documento, elimínalo para reemplazar
        if ($fase->documento && Storage::disk('public')->exists($fase->documento)) {
            Storage::disk('public')->delete($fase->documento);
        }

        // Guarda el archivo en storage/app/public/fases
        $path = $request->file('documento')->store('fases', 'public');

        $fase->update([
            'documento' => $path,
        ]);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Documento de la fase subido correctamente.');
    }

    /**
     * Eliminar el documento de una fase (sin borrar la fase)
     */
    public function destroyFaseDocumento(Project $project, ProjectFase $fase)
    {
        if ($fase->project_id !== $project->id) {
            abort(404);
        }

        if ($fase->documento && Storage::disk('public')->exists($fase->documento)) {
            Storage::disk('public')->delete($fase->documento);
        }

        $fase->update(['documento' => null]);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Documento de la fase eliminado correctamente.');
    }
}
