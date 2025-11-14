<?php

namespace App\Http\Controllers;

use App\Models\Semillero;
use App\Models\SemilleroFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SemilleroFileController extends Controller
{
    // ============================
    //  SUBIR ARCHIVO
    // ============================
    public function store(Request $request, Semillero $semillero)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:zip,rar,7z,tar,gz',
        ]);

        $file = $request->file('archivo');

        // Guardar archivo
        $path = $file->store('semillero_files', 'public');

        // Crear registro en DB vinculado al semillero
        $semillero->semilleroFiles()->create([
            'nombre_original' => $file->getClientOriginalName(),
            'ruta'            => $path,
        ]);

        return back()->with('success', 'Archivo subido correctamente.');
    }

    // ============================
    //  DESCARGAR ARCHIVO
    // ============================
    public function download(Semillero $semillero, SemilleroFile $semilleroFile)
    {
        // Verificar que el archivo pertenece al semillero
        if ($semilleroFile->semillero_id !== $semillero->id) {
            abort(403, 'Este archivo no pertenece a este semillero.');
        }

        return Storage::disk('public')->download(
            $semilleroFile->ruta,
            $semilleroFile->nombre_original
        );
    }

    // ============================
    //  ELIMINAR ARCHIVO
    // ============================
    public function destroy(Semillero $semillero, SemilleroFile $semilleroFile)
    {
        if ($semilleroFile->semillero_id !== $semillero->id) {
            abort(403, 'Este archivo no pertenece a este semillero.');
        }

        // Eliminar archivo del storage
        Storage::disk('public')->delete($semilleroFile->ruta);

        // Eliminar registro DB
        $semilleroFile->delete();

        return back()->with('success', 'Archivo eliminado correctamente.');
    }
}
