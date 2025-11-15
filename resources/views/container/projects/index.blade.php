@extends('layouts.dashboard')

@section('content')

    {{-- Contenedor principal --}}
    <div class="max-w-7xl mx-auto">

        {{-- Encabezado --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Gestión de Proyectos</h1>
                    <p class="text-muted-foreground">Administra los Proyectos de investigacion del CEFA</p>
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
                                  d="M16 7a4 4 0 11-8 0 4 4 0
                                  018 0zM12 14a7 7 0 00-7 7h14a7
                                  7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mensajes de confirmacion --}}
        @include('partials.session-message')

        <div class="px-6 py-4 border-b border-border bg-muted/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2
                                  2H5a2 2 0 01-2-2v-6a2 2 0
                                  012-2m14 0V9a2 2 0 00-2-2M5
                                  11V9a2 2 0 012-2m0 0V5a2 2 0
                                  012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-foreground">Proyectos De Investigacion</h2>
                </div>

                {{-- Botón a la derecha --}}
                @can('projects.create')
                    <a href="{{ route('projects.create') }}"
                       class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-medium
                       transition-all duration-200 flex items-center space-x-2 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nuevo Proyecto</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    {{-- Tabla AJAX --}}
    <div class="mt-6 bg-card rounded-lg shadow-sm border border-border p-4">
        <div class="overflow-x-auto rounded-lg">
            <table id="projectTable" class="w-full text-sm text-left border-collapse">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="px-4 py-3 text-foreground font-semibold"></th>
                        <th class="px-4 py-3 text-foreground font-semibold">Proyecto</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Semillero</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Director</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Fase Actual</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Fecha Inicio</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Fecha Fin</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- ================== CDNs & SCRIPT ================== --}}
    <link rel="stylesheet" href="{{ asset('css/dataTable/scriptsStyle.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#projectTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route("projects.index") }}',
                columns: [
                    {data: 'id', name: 'id'},

                    // NOMBRE DEL PROYECTO
                    {
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 3h8l4 4v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>
                            `;
                        }
                    },

                    // SEMILLERO
                    {
                        data: 'semillero_id',
                        name: 'semillero_id',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 21h18M6 21V9m12 12V9m-9 12V3h6v18" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>
                            `;
                        }
                    },

                    // DIRECTOR
                    {
                        data: 'director_id',
                        name: 'director_id',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5.121 17.804A8 8 0 1118.88 17.804M12 9a3 3 0 100-6 3 3 0 000 6z" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>`;
                        }
                    },

                    // FASE ACTUAL
                    {
                        data: 'fase_actual',
                        name: 'fase_actual',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 5v14m0-14l7 4 7-4v10l-7 4-7-4" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>`;
                        }
                    },

                    // FECHA INICIO
                    {
                        data: 'fecha_inicio',
                        name: 'fecha_inicio',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3M3 9h18M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>`;
                        }
                    },

                    // FECHA FIN
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 9l-4 4-2-2m-6 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-foreground">${data}</span>
                                </div>`;
                        }
                    },

                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ],
                language: { url: '/datatables/i18n/es-ES.json' },
                pageLength: 10,
                responsive: true
            });

            // Filtro en tiempo real
            $('#searchProject').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>

@endsection
