@extends('layouts.dashboard')

@section('content')

    {{-- Contenedor principal --}}
    <div class="max-w-7xl mx-auto">

        {{-- Encabezado --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Gestión de Líderes de Semilleros</h1>
                    <p class="text-muted-foreground">Administra los líderes de semilleros del sistema CEFA</p>
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

        {{-- Mensajes de éxito --}}
        @if (session('success'))
            <div class="mb-6 bg-primary/10 border border-primary/20 text-primary px-4 py-4 rounded-lg">
                <div class="flex items-start space-x-3">
                    <svg
                        class="w-5 h-5 flex-shrink-0 mt-0.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18
                            0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

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
                    <h2 class="text-lg font-semibold text-foreground">Líderes de semilleros</h2>
                </div>
                {{-- Botón a la derecha --}}
                @can('directores.create')
                    <a href="{{ route('container.director.create') }}"
                       class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-medium
                       transition-all duration-200 flex items-center space-x-2 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nuevo Líder</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    {{-- Tabla AJAX --}}
    <div class="mt-6 bg-card rounded-lg shadow-sm border border-border p-4">
        <div class="overflow-x-auto rounded-lg">
            <table id="directoresTable" class="w-full text-sm text-left border-collapse">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="px-4 py-3 text-foreground font-semibold"></th>
                        <th class="px-4 py-3 text-foreground font-semibold">Líder</th>
                        <th class="px-4 py-3 text-foreground font-semibold">Correo Electrónico</th>
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
            const table = $('#directoresTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route("directores.index") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M16 7a4 4 0 11-8 0 4 4 0
                                                  018 0zM12 14a7 7 0 00-7 7h14a7
                                                  7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-foreground">${data}</p>
                                        <p class="text-xs text-muted-foreground">Líder de semilleros</p>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data) {
                            return `
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 4.26a2 2 0 002.22
                                              0L21 8M5 19h14a2 2 0 002-2V7a2 2 0
                                              00-2-2H5a2 2 0 01-2 2v10a2 2 0
                                              002 2z" />
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
            $('#searchDirector').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection
