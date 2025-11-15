@extends('layouts.dashboard')

@section('content')
    {{-- Reemplazando diseño básico con diseño SENA profesional --}}
    <div class="max-w-4xl mx-auto">
        {{-- Header mejorado con iconografía SENA --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Crear Proyecto</h1>
                    <p class="text-muted-foreground">Registra un nuevo proyecto de investigación en el sistema CEFA</p>
                </div>
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Mejorando mensajes de error con diseño SENA --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-medium text-red-800 mb-2">Se encontraron los siguientes errores:</h4>
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Formulario rediseñado con estilo SENA profesional --}}
        <div class="bg-card rounded-lg shadow-sm border border-border overflow-hidden">
            <div class="px-6 py-4 border-b border-border bg-muted/30">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-foreground">Información del Proyecto</h3>
                        <p class="text-sm text-muted-foreground">Completa los datos del nuevo proyecto de investigación</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('projects.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Campo nombre con iconografía mejorada --}}
                    <div class="space-y-2 md:col-span-2">
                        <label for="nombre" class="block text-sm font-medium text-foreground">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span>Nombre del Proyecto</span>
                            </div>
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                            class="w-full px-3 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200"
                            placeholder="Ingresa el nombre del proyecto" required>
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo descripción con iconografía mejorada --}}
                    <div class="space-y-2 md:col-span-2">
                        <label for="descripcion" class="block text-sm font-medium text-foreground">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Descripción</span>
                            </div>
                        </label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="w-full px-3 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 resize-none"
                            placeholder="Describe los objetivos y alcance del proyecto de investigación">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo semillero con iconografía mejorada --}}
                    <div class="space-y-2">
                        <label for="semillero_id" class="block text-sm font-medium text-foreground">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Semillero</span>
                            </div>
                        </label>
                        <select id="semillero_id" name="semillero_id"
                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 bg-background"
                            required>
                            <option value="">Seleccione un semillero</option>
                            @forelse($semilleros as $semillero)
                                <option value="{{ $semillero->id }}">
                                    {{ $semillero->titulo }}
                                </option>
                            @empty
                                <option disabled>No hay semilleros registrados</option>
                            @endforelse
                        </select>
                        @error('semillero_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo fecha con iconografía mejorada --}}
                    <div class="space-y-2">
                        <label for="fecha_fin" class="block text-sm font-medium text-foreground">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Fecha de Finalización</span>
                            </div>
                        </label>
                        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}"
                            class="w-full px-3 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200"
                            required>
                        @error('fecha_fin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Botones rediseñados con estilo SENA --}}
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-border">
                    <a href="{{ route('projects.index') }}"
                        class="bg-muted hover:bg-muted/80 text-muted-foreground px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Cancelar</span>
                    </a>
                    <button type="submit"
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Crear Proyecto</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Agregando información adicional con diseño SENA --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="font-medium text-blue-800 mb-1">Registro de Proyecto</h4>
                    <p class="text-sm text-blue-700">Una vez creado el proyecto, podrás hacer seguimiento a las diferentes
                        fases de desarrollo: propuesta, análisis, diseño, desarrollo, prueba e implantación.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- TomSelect JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Select para usuarios con búsqueda
            new TomSelect("#semillero_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Buscar Semillero Por Nombre",
                searchField: ['text'],
                render: {
                    option: function(data, escape) {
                              return `
                            <div class="py-2 px-3 hover:bg-gray-100">
                                <div class="font-medium">${escape(data.text)}</div>
                            </div>`;
                    }
                }
            });
        });

    </script>


@endsection
