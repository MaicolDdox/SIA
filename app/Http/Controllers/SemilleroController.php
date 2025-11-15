<?php

namespace App\Http\Controllers;

use App\Models\Semillero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;

class SemilleroController extends Controller
{

    public function index(Request $request)
    {
        // Si la petición es AJAX (desde DataTable)
        if ($request->ajax()) {
            $semilleros = Semillero::all()->map(function ($semillero) {
            return [
                'id'           => $semillero->id,
                'imagen'       => asset('storage/' . $semillero->imagen),
                'titulo'       => Str::limit($semillero->titulo, 30),
                'descripcion'  => Str::limit($semillero->descripcion, 60),
                'fecha'        => $semillero->created_at->format('Y-m-d'),
                'acciones'     => view('container.semilleros.partials.actions', compact('semillero'))->render(),
            ];
        });

            return response()->json(['data' => $semilleros]);
        }

        // Si no es AJAX, devuelve la vista normal
        return view('container.semilleros.index');
    }

    public function create()
    {
        return view('container.semilleros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255|unique:semilleros,titulo',
            'descripcion' => 'nullable|string',
            'imagen' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Guardar la imagen en storage/app/public/semilleros
        $path = $request->file('imagen')->store('semilleros', 'public');

        // Crear semillero
        Semillero::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $path, // guardamos la ruta relativa
        ]);

        return redirect()->route('semilleros.index')
            ->with('success', 'Semillero creado correctamente.');
    }


    public function show(Semillero $semillero)
    {
        $semillero->load(['semilleroFiles']);
        return view('container.semilleros.show', compact('semillero'));
    }

    public function edit(Semillero $semillero)
    {
        return view('container.semilleros.edit', compact('semillero'));
    }

    public function update(Request $request, Semillero $semillero)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $data = $request->only(['titulo', 'descripcion']);

        // Si se subió una nueva imagen
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($semillero->imagen && Storage::disk('public')->exists($semillero->imagen)) {
                Storage::disk('public')->delete($semillero->imagen);
            }

            // Guardar nueva
            $path = $request->file('imagen')->store('semilleros', 'public');
            $data['imagen'] = $path;
        }

        $semillero->update($data);

        return redirect()->route('semilleros.index')
            ->with('success', 'Semillero actualizado correctamente.');
    }


    public function destroy(Semillero $semillero)
    {

        //verificamos que antes de borrar el semillero
        //no tenga proyectos creados o pendientes
        $verifySemillero = DB::table('projects')
                        ->where('semillero_id', $semillero->id)
                        ->exists();

        if ($verifySemillero) {
            return redirect()->route('semilleros.index')
                             ->with('error', 'no se puede borrar el semillero por que tiene proyectos pendientes');
        }else {

        // Borrar imagen asociada si existe
        if ($semillero->imagen && Storage::disk('public')->exists($semillero->imagen)) {
            Storage::disk('public')->delete($semillero->imagen);
        }

        //borramos semillero
        $semillero->delete();

        //redireccionamos a la tabla index
        return redirect()->route('semilleros.index')
            ->with('success', 'Semillero eliminado correctamente.');
        }

    }
}
