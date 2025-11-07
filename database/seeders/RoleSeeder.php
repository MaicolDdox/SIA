<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // -------------------------
        // Creación de Roles
        // -------------------------
        $superAdmin = Role::create(['name' => 'super_admin']);
        $directorSemilleros = Role::create(['name' => 'director_semilleros']);
        $liderSemilleros = Role::create(['name' => 'lider_semilleros']);
        $instructorIntegrado = Role::create(['name' => 'instructor_integrado']);
        $aprendizIntegrado = Role::create(['name' => 'aprendiz_integrado']);

        // -------------------------
        // Creación de Permirsos
        // -------------------------

        // Permisos para semilleros
        Permission::create(['name' => 'semilleros.index']);
        Permission::create(['name' => 'semilleros.create']);
        Permission::create(['name' => 'semilleros.edit']);
        Permission::create(['name' => 'semilleros.delete']);

        // Permisos para directores
        Permission::create(['name' => 'directores.index']);
        Permission::create(['name' => 'directores.create']);
        Permission::create(['name' => 'directores.edit']);
        Permission::create(['name' => 'directores.delete']);
        Permission::create(['name' => 'directores.history']); // historial de asignaciones

        // Permisos para integrantes
        Permission::create(['name' => 'integrantes.index']);
        Permission::create(['name' => 'integrantes.create']);
        Permission::create(['name' => 'integrantes.edit']);
        Permission::create(['name' => 'integrantes.delete']);
        Permission::create(['name' => 'integrantes.history']);

        // Permisos para integrantes en proyectos
        Permission::create(['name' => 'project_integrantes.index']);
        Permission::create(['name' => 'project_integrantes.create']);
        Permission::create(['name' => 'project_integrantes.edit']);
        Permission::create(['name' => 'project_integrantes.delete']);
        Permission::create(['name' => 'project_integrantes.history']);

        // Permisos para projects
        Permission::create(['name' => 'projects.index']);
        Permission::create(['name' => 'projects.create']);
        Permission::create(['name' => 'projects.edit']);
        Permission::create(['name' => 'projects.delete']);
        Permission::create(['name' => 'projects.advance']);
        Permission::create(['name' => 'projects.report']);

        // Permisos para events (calendario)
        Permission::create(['name' => 'events.index']);

        // Permisos para datos extra de cuenta
        Permission::create(['name' => 'datos_extra_director_semilleros']);
        Permission::create(['name' => 'datos_extra_lider_semilleros']);
        Permission::create(['name' => 'datos_extra_aprendiz_integrado']);
        Permission::create(['name' => 'datos_extra_instructor_integrado']);


        // -------------------------
        // Asignar permisos a roles
        // -------------------------

        //Super administrador
        $superAdmin->givePermissionTo(Permission::all());

        // Director de semilleros
        $directorSemilleros->givePermissionTo([
            'semilleros.index',
            'semilleros.create',
            'semilleros.edit',
            'semilleros.delete',
            'directores.index',
            'directores.create',
            'directores.edit',
            'directores.delete',
            'directores.history',
            'integrantes.index',
            'integrantes.history',
            'projects.index',
            'projects.report',
            'events.index',
            'datos_extra_director_semilleros',
        ]);

        // Director de grupo
        $liderSemilleros->givePermissionTo([
            'semilleros.index', // Solo ve su grupo
            'integrantes.index',
            'integrantes.create',
            'integrantes.edit',
            'integrantes.delete',
            'integrantes.history',
            'project_integrantes.index',
            'project_integrantes.create',
            'project_integrantes.edit',
            'project_integrantes.delete',
            'project_integrantes.history',
            'projects.index',
            'projects.create',
            'projects.edit',
            'projects.delete',
            'projects.advance',
            'projects.report',
            'events.index',
            'datos_extra_lider_semilleros',
        ]);

        //instructor integrado
        $instructorIntegrado->givePermissionTo([
            'semilleros.index',
            'project_integrantes.index',
            'projects.index',
            'events.index',
            'datos_extra_instructor_integrado',
        ]);

        // Aprendiz integrado
        $aprendizIntegrado->givePermissionTo([
            'semilleros.index',
            'project_integrantes.index',
            'projects.index',
            'events.index',
            'datos_extra_aprendiz_integrado',
        ]);
    }
}
