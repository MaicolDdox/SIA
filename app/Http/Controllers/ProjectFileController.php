<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    // ============================
    //  SUBIR ARCHIVO
    // ============================
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:zip,rar,7z,tar,gz',
        ]);

        $file = $request->file('archivo');

        // Guardar archivo
        $path = $file->store('projects_files', 'public');

        // Crear registro en DB vinculado al semillero
        $project->files()->create([
            'nombre_original' => $file->getClientOriginalName(),
            'ruta'            => $path,
        ]);

        return back()->with('success', 'Archivo subido correctamente.');
    }

    // ============================
    //  DESCARGAR ARCHIVO
    // ============================
    public function download(Project $project, ProjectFile $file)
    {
        // Verificar que el archivo pertenece al semillero
        if ($file->project_id !== $project->id) {
            abort(403, 'Este archivo no pertenece a este Projecto.');
        }

        return Storage::disk('public')->download(
            $file->ruta,
            $file->nombre_original
        );
    }

    // ============================
    //  ELIMINAR ARCHIVO
    // ============================
    public function destroy(Project $project, ProjectFile $file)
    {
        if ($file->project_id !== $project->id) {
            abort(403, 'Este archivo no pertenece a este Projecto.');
        }

        // Eliminar archivo del storage
        Storage::disk('public')->delete($file->ruta);

        // Eliminar registro DB
        $file->delete();

        return back()->with('success', 'Archivo eliminado correctamente.');
    }

}

