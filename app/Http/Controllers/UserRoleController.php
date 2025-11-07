<?php

namespace App\Http\Controllers;

use App\Models\Semillero;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * Display a listing of users without roles.
     */
    public function index()
    {
        // Obtener usuarios que no tienen roles asignados usando Laravel Permission
        // Consultamos directamente la tabla pivot model_has_roles
        $userIdsWithRoles = \DB::table('model_has_roles')
            ->where('model_type', User::class)
            ->pluck('model_id')
            ->toArray();

        $usuariosSinRol = User::whereNotIn('id', $userIdsWithRoles)
            ->with('dataUser') // Cargar la relación con data_users
            ->get();

        return view('container.director.create', compact('usuariosSinRol'));
    }


    /**
     * Store a newly created role assignment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rol' => 'required|in:lider_semillero,instructor_integrado,aprendiz_integrado'
        ]);

        try {
            // Buscar el usuario
            $user = User::findOrFail($request->user_id);

            // Verificar que el usuario no tenga roles asignados usando Laravel Permission
            $hasRoles = \DB::table('model_has_roles')
                ->where('model_type', User::class)
                ->where('model_id', $user->id)
                ->exists();

            if ($hasRoles) {
                return back()->with('error', 'El usuario ya tiene un rol asignado.');
            }

            // Mapear los valores a los nombres de roles reales
            $roleNames = [
                'lider_semillero' => 'lider_semilleros',
                'instructor_integrado' => 'instructor_integrado',
                'aprendiz_integrado' => 'aprendiz_integrado',
                'director_semilleros' => 'director_semilleros'
            ];

            $roleName = $roleNames[$request->rol];

            // Buscar o crear el rol
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

            // Asignar el rol al usuario
            $user->assignRole($role);

            return redirect()->route('dashboard')
                ->with('success', 'Rol asignado exitosamente al usuario.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al asignar el rol: ' . $e->getMessage());
        }
    }

}
