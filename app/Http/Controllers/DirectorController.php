<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DirectorController extends Controller
{
   public function index(Request $request)
    {
        // Si la solicitud es AJAX, devolvemos JSON para DataTables
        if ($request->ajax()) {
            // Obtenemos los usuarios con rol 'lider_semilleros'
            $lideres = User::role('lider_semilleros')
                ->select(['id', 'name', 'email'])
                ->get();

            // Agregamos una columna personalizada 'acciones'
            $lideres = $lideres->map(function ($lider) {
                return [
                    'id' => $lider->id,
                    'name' => $lider->name,
                    'email' => $lider->email,
                    'acciones' => view('container.director.partials.actions', compact('lider'))->render(),
                ];
            });

            // DataTables espera una clave 'data'
            return response()->json(['data' => $lideres]);
        }

        // Si no es AJAX, cargamos la vista normalmente
        return view('container.director.index');
    }

    public function create()
    {
        return view('container.director.create');
    }

    public function show($id)
    {
        $integrante = User::findOrFail($id);
        return view('container.director.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('director_grupo');

        return redirect()->route('directores.index')->with('success', 'Director creado correctamente.');
    }

    public function edit(User $directore)
    {
        return view('container.director.edit', compact('directore'));
    }

    public function update(Request $request, User $directore)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$directore->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Si enviaron password, la encriptamos y la añadimos
        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $directore->update($data);

        return redirect()->route('directores.index')->with('success', 'Director actualizado correctamente.');
    }

    public function destroy(User $directore)
    {
        $directore->delete();

        return redirect()->route('directores.index')->with('success', 'Director eliminado correctamente.');
    }
}
