<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AprendizController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));

        $users = User::role(['aprendiz_integrado', 'instructor_integrado']) // varios roles
            ->when($q, function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->latest('created_at')
            ->paginate(10)
            ->appends(['q' => $q]);

        return view('container.integrantes.index', compact('users', 'q'));
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

        $user->assignRole('aprendiz_integrado');

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz creado correctamente.');
    }

    public function edit($id)
    {
        $aprendiz = User::findOrFail($id);

        return view('container.integrantes.edit', compact('aprendiz'));
    }

    public function show($id)
    {
        $integrante = User::findOrFail($id);

        return view('container.integrantes.show', compact('integrante'));
    }

    public function update(Request $request, $id)
    {
        $aprendiz = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$aprendiz->id,
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

        $aprendiz->update($data);

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz actualizado correctamente.');
    }

    public function destroy($id)
    {
        $aprendiz = User::findOrFail($id);
        $aprendiz->delete();

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz eliminado correctamente.');
    }
}
