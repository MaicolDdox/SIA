@extends('layouts.dashboard')
@section('content')
    {{-- Contenedor principal --}}
    <div class="max-w-7xl mx-auto">

        {{-- Encabezado --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Gestión de Integrantes</h1>
                    <p class="text-muted-foreground">Administra los integrantes del CEFA</p>
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
                    <h2 class="text-lg font-semibold text-foreground">Integrantes</h2>
                </div>

                {{-- Botón a la derecha --}}
                @can('integrantes.create')
                    <a href="{{ route('container.director.create') }}"
                       class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-medium
                       transition-all duration-200 flex items-center space-x-2 shadow-sm hover:shadow-md">

                       <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nuevo Integrante</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>




        {{-- Contenedor tabla --}}
        <div class="bg-card rounded-lg shadow-sm border border-border overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-muted/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-muted-foreground">#</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-muted-foreground">Integrante</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-muted-foreground">Correo Electrónico
                            </th>
                            @can('integrantes.create')
                                <th class="px-6 py-4 text-center text-sm font-medium text-muted-foreground">Acciones</th>
                            @endcan
                        </tr>
                    </thead>

                    {{-- **CAMBIO: agregué el id="IntegranteTable" para que el JS lo encuentre y reemplace su contenido** --}}
                    <tbody id="aprendicesTable" class="divide-y divide-border">
                        @forelse ($users as $index => $aprendiz)
                            <tr class="hover:bg-muted/30 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $users->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-foreground">{{ $aprendiz->name }}</p>
                                            <p class="text-xs text-muted-foreground">Integrante CEFA</p>
                                            <p class="text-xs text-muted-foreground">
                                            {{ auth()->user()->roles->first()->name ?? 'Sin rol' }}</p>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-foreground">{{ $aprendiz->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        {{-- Botón Ver con icono --}}
                                        <a href="{{ route('aprendices.show', $aprendiz->id) }}"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors duration-200 group"
                                            title="Ver detalles del aprendiz">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @can('integrantes.create')
                                            <a href="{{ route('aprendices.edit', $aprendiz->id) }}"
                                                class="bg-amber-100 hover:bg-amber-200 text-amber-700 p-2 rounded-lg transition-colors duration-200 group"
                                                title="Editar semillero">
                                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('aprendices.destroy', $aprendiz->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar este Integrante?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors duration-200 group"
                                                    title="Eliminar semillero">
                                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 group-hover:rotate-12 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </div>
                                        <div class="text-center">
                                            <h3 class="text-lg font-medium text-foreground mb-1">No hay Integrante
                                                registrados</h3>
                                            <p class="text-sm text-muted-foreground mb-4">Comienza registrando el primer
                                                Integrante en el sistema</p>
                                            @can('integrantes.create')
                                                <a href="{{ route('container.director.create') }}"
                                                    class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 inline-flex items-center space-x-2">
                                                    <span>Registrar Primer Integrante</span>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                    <h4 class="font-medium text-blue-800 mb-1">Gestión de Integrante</h4>
                    <p class="text-sm text-blue-700">Los Integrante pueden acceder al sistema con sus credenciales para
                        participar en grupos de semilleros de investigación y gestionar sus proyectos académicos.</p>
                </div>
            </div>
        </div>

        {{-- **CAMBIO: agregué id="pagination" alrededor de los links para que el JS lo encuentre** --}}
        @if ($users->hasPages())
            <div id="pagination" class="mt-6">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif

@endsection
