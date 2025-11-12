<?php

namespace App\Http\Controllers;

use App\Models\SemilleroFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Semillero;

class SemilleroFileController extends Controller
{
     // Subir archivo
    public function store(Request $request, Semillero $semillero)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:zip,rar,7z,tar,gz',
        ]);

        $file = $request->file('archivo');
        $path = $file->store('semillero_file', 'public');

        $semillero->semilleroFiles()->create([
            'nombre_original' => $file->getClientOriginalName(),
            'ruta' => $path,
        ]);

        return back()->with('success', 'Archivo agregado correctamente.');
    }

    // Descargar (opcional: forzar descarga)
    public function download(SemilleroFile $semilleroFile)
    {
        return Storage::disk('public')->download($semilleroFile->ruta, $semilleroFile->nombre_original);
    }

    // Eliminar archivo
    public function destroy(SemilleroFile $file)
    {
        if ($file->ruta && Storage::disk('public')->exists($file->ruta)) {
            Storage::disk('public')->delete($file->ruta);
        }
    
        $file->delete();
    
        return back()->with('success', 'Archivo eliminado correctamente.');
    }

}
