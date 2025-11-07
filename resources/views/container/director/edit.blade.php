@extends('layouts.dashboard')
@section('content')

<!-- TomSelect CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto">

        <!-- header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Editar Lider de semillero</h1>
                    <p class="text-muted-foreground">Modifica la información del Lider desemilleros en el sistema SIA</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">

                        <svg
                            class="w-6 h-6 text-primary"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2
                                0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2
                                2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensaje de error -->
        @if (session('error'))
            <div class="mb-6 bg-red-100 border border-red-300 px-4 py-4 rounded-lg">
                <div class="flex items-start space-x-3">
                    <div>
                        <p class="text-red-500 text-sm mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- contenedor tipo card -->
        <div class="bg-card rounded-lg shadow-sm border border-border ">
            <div class="px-6 py-4 border-b border-border bg-muted/30">
                <h3 class="text-lg font-semibold text-foreground">Información del Lider de semilleros</h3>
                <p class="text-sm text-muted-foreground">Actualice los datos del Lider de semilleros {{ $directore->name }}
                </p>
            </div>

            {{-- formulario para editar --}}
            <div class="p-6">
                <form action="{{ route('directores.update', $directore) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- contener de los inputs --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- nombre del lider de semillero --}}
                        <div class="space-y-2">
                            <label
                                for="name"
                                class="text-sm font-medium text-foreground
                                flex items-center space-x-2">

                                <svg
                                    class="w-4 h-4 text-primary"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Nombre del Lider de semillero</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="w-full px-4 py-3 border border-border
                                rounded-lg focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-colors duration-200
                                bg-background text-foreground placeholder-muted-foreground"
                                value="{{ old('name', $directore->name) }}"
                                placeholder="Ingrese el nombre completo"
                                required>
                        </div>

                        {{-- email --}}
                        <div class="space-y-2">

                            <label
                                for="email"
                                class="text-sm font-medium text-foreground
                                flex items-center space-x-2">

                                <svg
                                    class="w-4 h-4 text-primary"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21
                                        8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2
                                        2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Correo Electrónico</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="w-full px-4 py-3 border border-border
                                rounded-lg focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-colors duration-200
                                bg-background text-foreground placeholder-muted-foreground"
                                value="{{ old('email', $directore->email) }}"
                                placeholder="director@cefa.edu.co"
                                required>
                        </div>

                        {{-- password --}}
                        <div class="space-y-2">
                            <label
                                for="password"
                                class="block text-sm font-medium
                                text-foreground mb-2">
                                Cambiar Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                    <svg
                                        class="h-5 w-5 text-muted-foreground"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2
                                            2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002
                                            2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    name="password"
                                    type="password"
                                    id="password"
                                    autocomplete="new-password"
                                    placeholder="Crea una contraseña segura"
                                    class="input-focus w-full pl-10 pr-4 py-3 border
                                    border-border rounded-lg bg-background text-foreground
                                    placeholder-muted-foreground focus:outline-none" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- confirmar contraseña --}}
                        <div class="space-y-2">
                            <label
                                for="password_confirmation"
                                class="block text-sm font-medium text-foreground mb-2">
                                Confirmar Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                    <svg
                                        class="h-5 w-5 text-muted-foreground"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0
                                            11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="Confirma tu contraseña"
                                    class="input-focus w-full pl-10 pr-4 py-3
                                    border border-border rounded-lg bg-background
                                    text-foreground placeholder-muted-foreground
                                    focus:outline-none" />
                                @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- rol --}}
                        <div class="space-y-2">
                            <label
                            for="semillero_name"
                            class="text-sm font-medium text-foreground">
                                    Rol
                            </label>
                            <select
                                name="rol"
                                id="rol"
                                class="w-full px-4 py-3 border border-border rounded-lg
                                focus:ring-2 focus:ring-primary/20 focus:border-primary
                                transition-colors duration-200 bg-background"
                                required>
                                <option disabled selected>{{ $nameRol }}</option>
                                @can('directores.create')
                                    <option value="lider_semillero">Líder de Semillero</option>
                                @endcan
                                @can('integrantes.create')
                                    <option value="instructor_integrado">Instructor Integrado</option>
                                    <option value="aprendiz_integrado">Aprendiz Integrado</option>
                                @endcan
                                @role('super_admin')
                                    <option value="director_semilleros">Director de Semilleros</option>
                                @endrole
                            </select>
                            <p class="mt-2 text-sm text-muted-foreground">Elige el rol que se asignará al usuario
                                seleccionado</p>
                        </div>
                    </div>

                    {{-- boton de cancelar formulario --}}
                    <div
                        class="flex flex-col sm:flex-row justify-between
                        items-center space-y-3 sm:space-y-0 sm:space-x-4
                        pt-6 border-t border-border">

                        {{-- redireccion a la tabla --}}
                        <a
                            href="{{ route('directores.index') }}"
                            class="w-full sm:w-auto bg-secondary hover:bg-secondary/80
                            text-secondary-foreground px-6 py-3 rounded-lg font-medium
                            transition-colors duration-200 flex items-center justify-center
                            space-x-2">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Cancelar</span>
                        </a>

                        {{-- boton deguardar cambios --}}
                        <button
                            type="submit"
                            class="w-full sm:w-auto bg-primary
                            hover:bg-primary/90 text-white px-6 py-3
                            rounded-lg font-medium transition-all duration-200
                            flex items-center justify-center space-x-2
                            shadow-sm hover:shadow-md">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- card con info adicional --}}
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">

                <svg
                    class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0
                        2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464
                        0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <h4 class="font-medium text-amber-800 mb-1">Nota importante</h4>
                    <p class="text-sm text-amber-700">Los cambios realizados se aplicarán inmediatamente. Si modifica el
                        correo electrónico, el director deberá usar la nueva dirección para acceder al sistema.</p>
                </div>
            </div>
        </div>
    </div>

     <!-- TomSelect JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // Select para roles
            new TomSelect("#rol", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Seleccione un rol...",
                render: {
                    option: function(data, escape) {
                        let description = '';
                        switch (data.value) {
                            case 'director_semilleros':
                                description = 'Gestionar semilleros y supervisa proyectos'
                                break;
                            case 'lider_semillero':
                                description = 'Gestiona proyectos y integraciones con asociaciones';
                                break;
                            case 'instructor_integrado':
                                description = 'Guía y asesora en el desarrollo de proyectos';
                                break;
                            case 'aprendiz_integrado':
                                description = 'Participa activamente en proyectos de investigación';
                                break;
                        }
                        return '<div class="py-2 px-3 hover:bg-gray-100">' +
                            '<div class="font-medium">' + escape(data.text) + '</div>' +
                            '<div class="text-sm text-gray-600">' + description + '</div>' +
                            '</div>';
                    }
                }
            });
        });
    </script>
@endsection
