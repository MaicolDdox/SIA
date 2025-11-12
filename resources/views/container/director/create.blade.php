@extends('layouts.dashboard')

@section('content')
    <!-- TomSelect CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Asignar Roles</h1>
                    <p class="text-muted-foreground">Asigna roles a usuarios que aún no tienen asignado ningún rol en el
                        sistema</p>
                </div>
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
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Mensajes de confirmacion --}}
        @include('partials.session-message')

        {{-- Formulario --}}
        <div class="bg-card rounded-lg shadow-sm border border-border">

            {{-- head del formulario --}}
            <div class="px-6 py-4 border-b border-border bg-muted/30">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-foreground">Formulario de Asignación de Roles</h3>
                        <p class="text-sm text-muted-foreground">Selecciona el usuario y el rol que deseas asignar</p>
                    </div>
                </div>
            </div>

            {{-- mensaje de error del formulario --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg mx-6 mt-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- si no existe usuarios sin rol --}}
            @if ($usuariosSinRol->isEmpty())
                <div class="p-6">
                    <div class="text-center py-8">
                        <svg
                            class="w-12 h-12 mx-auto text-muted-foreground mb-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112
                                0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5
                                0 2.5 2.5 0 015 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-foreground mb-2">No hay usuarios sin roles</h3>
                        <p class="text-muted-foreground">Todos los usuarios del sistema ya tienen roles asignados.</p>
                    </div>

                    {{-- boton para regresar --}}
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 bg-muted hover:bg-muted/80 text-muted-foreground rounded-lg font-medium transition-all duration-200 flex items-center space-x-2 border border-border">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Volver</span>
                        </a>
                    </div>
                </div>
            @else

            {{-- si, sí existe usuarios sin rol muestra: --}}
                <form action="{{ route('container.director.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">

                        {{-- header del formulario --}}
                        <div>
                            <label
                                for="user_id"
                                class="block text-sm font-medium
                                text-foreground mb-2">

                                <div class="flex items-center space-x-2">
                                    <svg
                                        class="w-4 h-4 text-primary"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018
                                        0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Usuario</span>
                                </div>
                            </label>

                            {{-- campo para seleccionar un usuario --}}
                            <select
                                name="user_id"
                                id="user_id"
                                class="w-full px-4 py-3 border border-border
                                rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary
                                transition-colors duration-200 bg-background"
                                required>
                                <option value="">Seleccione un usuario</option>
                                @foreach ($usuariosSinRol as $usuario)
                                    <option
                                        value="{{ $usuario->id }}"
                                        data-cedula="{{ $usuario->dataUser->numero_documento ?? 'Sin cédula' }}">
                                        {{ $usuario->name }} - {{ $usuario->dataUser->numero_documento ?? 'Sin cédula' }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-muted-foreground">Selecciona el usuario al que deseas asignar un rol
                            </p>
                        </div>

                        {{-- Campo de selección de rol --}}
                        <div>
                            <label
                                for="rol"
                                class="block text-sm font-medium text-foreground mb-2">
                                <div class="flex items-center space-x-2">
                                    <svg
                                        class="w-4 h-4 text-primary"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112
                                            2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0
                                            003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332
                                            9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span>Selecciona el Rol</span>
                                </div>
                            </label>

                            <select
                                name="rol"
                                id="rol"
                                class="w-full px-4 py-3 border border-border rounded-lg
                                focus:ring-2 focus:ring-primary/20 focus:border-primary
                                transition-colors duration-200 bg-background"
                                required>
                                <option value="">Seleccione un rol</option>
                                @can('directores.create')
                                    <option value="lider_semillero">Líder de Semillero</option>
                                @endcan
                                @can('integrantes.create')
                                    <option value="instructor_integrado">Instructor Integrado</option>
                                    <option value="aprendiz_integrado">Aprendiz Integrado</option>
                                @endcan
                                @role('super_admin')
                                    <option value="director_semilleros"> Director de Semilleros</option>
                                @endrole
                            </select>
                            <p class="mt-2 text-sm text-muted-foreground">Elige el rol que se asignará al usuario
                                seleccionado</p>
                        </div>
                    </div>

                    {{-- Botones rediseñados con efectos hover y iconos --}}
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-border">
                        <a
                            href="{{ route('directores.index') }}"
                            class="px-6 py-3 bg-muted hover:bg-muted/80
                            text-muted-foreground rounded-lg font-medium
                            transition-all duration-200 flex items-center
                            space-x-2 border border-border">

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
                        <button
                            type="submit"
                            class="px-6 py-3 bg-primary
                            hover:bg-primary/90 text-white
                            rounded-lg font-medium transition-all
                            duration-200 flex items-center space-x-2
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
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955
                                    11.955 0 0112 2.944a11.955 11.955 0
                                    01-8.618 3.04A12.02 12.02 0 003 9c0
                                    5.591 3.824 10.29 9 11.622 5.176-1.332
                                    9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Asignar Rol</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>

        {{-- Sección informativa adicional sobre el proceso --}}
        <div class="mt-6 bg-primary/5 border border-primary/20 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg
                    class="w-5 h-5 text-primary flex-shrink-0 mt-0.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="font-medium text-primary mb-1">Información sobre la Asignación de Roles</h4>
                    <p class="text-sm text-primary/80">
                        Una vez asignado el rol, el usuario tendrá acceso a las funcionalidades específicas de su rol.
                        <strong>Líder de Semillero:</strong> Gestiona proyectos.
                        <strong>Instructor Integrado:</strong> Participa como guía en proyectos.
                        <strong>Aprendiz Integrado:</strong> Participa activamente en el desarrollo de proyectos.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- TomSelect JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Select para usuarios con búsqueda
            new TomSelect("#user_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Buscar usuario por nombre o cédula...",
                searchField: ['text'],
                render: {
                    option: function(data, escape) {
                        return '<div class="py-2 px-3 hover:bg-gray-100">' +
                            '<div class="font-medium">' + escape(data.text.split(' - ')[0]) + '</div>' +
                            '<div class="text-sm text-gray-600">Cédula: ' + escape(data.text.split(' - ')[1]) + '</div>' +
                            '</div>';
                    }
                }
            });

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
