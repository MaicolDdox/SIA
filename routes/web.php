<?php

use App\Http\Controllers\AprendizController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\ProjectIntegranteController;
use App\Http\Controllers\SemilleroController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->name('dashboard');

// -------------------------
// Rutas protegidas
// -------------------------
Route::middleware(['auth'])->group(function () {

    // -------------------------
    // Rutas de Semilleros
    // -------------------------
    Route::resource('semilleros', SemilleroController::class);

    // / -------------------------
    // Rutas de Fases de Proyecto
    // -------------------------
    Route::prefix('projects/{project}/fases')->group(function () {
        Route::get('create', [ProjectController::class, 'createFase'])->name('projects.fases.create');
        Route::post('/', [ProjectController::class, 'storeFase'])->name('projects.fases.store');
        Route::get('{fase}/edit', [ProjectController::class, 'editFase'])->name('projects.fases.edit');
        Route::put('{fase}', [ProjectController::class, 'updateFase'])->name('projects.fases.update');
        Route::delete('{fase}', [ProjectController::class, 'destroyFase'])->name('projects.fases.destroy');
    });

    // -------------------------
    // Rutas de Eventos
    // -------------------------
    Route::resource('events', EventController::class);

    // -------------------------
    // Rutas de Proyectos
    // -------------------------
    Route::post('projects/{project}/advance', [ProjectController::class, 'advance'])->name('projects.advance');

    Route::post('projects/{project}/fases/{fase}/documento', [ProjectController::class, 'storeFaseDocumento'])
        ->name('projects.fases.documento.store');

     Route::delete('projects/{project}/fases/{fase}/documento', [ProjectController::class, 'destroyFaseDocumento'])
     ->name('projects.fases.documento.destroy');

     Route::prefix('projects/{project}')->group(function () {
         Route::post('/files', [ProjectFileController::class, 'store'])->name('projects.files.store');
     });

     Route::get('/files/{file}/download', [ProjectFileController::class, 'download'])
     ->name('projects.files.download');
     
     Route::delete('/files/{file}', [ProjectFileController::class, 'destroy'])
     ->name('projects.files.destroy');

    Route::resource('projects', ProjectController::class);

    // asociar aprendices con proyectos
    Route::get('/project-integrantes', [ProjectIntegranteController::class, 'index'])
        ->name('project_integrantes.index');

    Route::get('/project-integrantes/create', [ProjectIntegranteController::class, 'create'])
        ->name('project_integrantes.create');

    Route::post('/project-integrantes', [ProjectIntegranteController::class, 'store'])
        ->name('project_integrantes.store');

    Route::delete('/projects/{project}/aprendices/{aprendiz}', [ProjectIntegranteController::class, 'destroy'])
        ->name('project.aprendices.destroy');

    // -------------------------
    // Rutas de Aprendices
    // -------------------------
    Route::resource('aprendices', AprendizController::class);

    // -------------------------
    // Rutas de Directores
    // -------------------------
    Route::resource('directores', DirectorController::class);

    Route::get('/projects/{project}/fases/{fase}', [ProjectController::class, 'showFase'])
        ->name('projects.fases.show');

    // Rutas de account
    Route::get('/perfil/datos', [DataUserController::class, 'edit'])->name('data_users.edit');
    Route::post('/perfil/datos', [DataUserController::class, 'storeOrUpdate'])->name('data_users.store');

    // Rutas para asignación de roles a usuarios
    Route::get('/container/director/create', [UserRoleController::class, 'index'])->name('container.director.create');
    Route::post('/container/director/store', [UserRoleController::class, 'store'])->name('container.director.store');

    // Ruta opcional para listar usuarios con roles asignados
    Route::get('/users-with-roles', [UserRoleController::class, 'list'])->name('user-roles.list');

    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
