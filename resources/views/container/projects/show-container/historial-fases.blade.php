<div class="bg-card rounded-lg shadow-sm border border-border overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-border bg-muted/30">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-foreground">Historial de Fases</h3>
                <p class="text-sm text-muted-foreground">Seguimiento del progreso del proyecto</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        @if ($project->fases->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-border">
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Fase</th>
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Fecha Inicio</th>
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Fecha Fin</th>
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Estado</th>
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Acciones</th>
                            <th class="text-left py-3 px-4 font-semibold text-foreground">Documentos</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach ($project->fases as $fase)
                            <tr class="hover:bg-muted/50 transition-colors duration-200">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-foreground">{{ ucfirst($fase->nombre) }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-muted-foreground">
                                    {{ \Carbon\Carbon::parse($fase->fecha_inicio)->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-4 text-muted-foreground">
                                    {{ $fase->fecha_fin ? \Carbon\Carbon::parse($fase->fecha_fin)->format('d/m/Y') : 'En curso' }}
                                </td>
                                <td class="py-4 px-4">
                                    @if ($fase->fecha_fin)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completada
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            En progreso
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('projects.fases.show', ['project' => $project->id, 'fase' => $fase->id]) }}"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors duration-200 group"
                                            title="Ver fase">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>

                                </td>
                                {{-- Mejorando el diseño del formulario de subida de documentos --}}
                                <td class="py-4 px-4 text-center">
                                    @if ($fase->documento)
                                        {{-- Enlace para ver o descargar con diseño SENA mejorado --}}
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ Storage::url($fase->documento) }}" target="_blank"
                                                class="inline-flex items-center space-x-2 px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 rounded-lg text-sm font-medium transition-all duration-200 border border-green-200 hover:border-green-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <!-- Icono: archivo + flecha hacia abajo -->
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 11v6m0 0l-3-3m3 3l3-3M6 8V6a2 2 0 012-2h4l4 4v2" />
                                                </svg>
                                                <span></span>
                                            </a>

                                            {{-- Botón eliminar mejorado --}}
                                            <form
                                                action="{{ route('projects.fases.documento.destroy', [$project->id, $fase->id]) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('¿Eliminar este documento?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center space-x-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 rounded-lg text-sm font-medium transition-all duration-200 border border-red-200 hover:border-red-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        {{-- Formulario mejorado para subir documento --}}
                                        <form
                                            action="{{ route('projects.fases.documento.store', [$project->id, $fase->id]) }}"
                                            method="POST" enctype="multipart/form-data" class="space-y-3">
                                            @csrf

                                            {{-- Componente de carga de archivos mejorado --}}
                                            <x-file-upload-inline
                                                name="documento"
                                                accept=".pdf,.doc,.docx"
                                                :required="true"
                                                label="Subir archivo comprimido"
                                                hint="Solo formatos PDF O WORD"
                                                />

                                            {{-- Botón de subir mejorado --}}
                                            <button type="submit"
                                                class="inline-flex items-center space-x-2 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span>Subir Documento</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-muted-foreground mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <h3 class="text-lg font-medium text-foreground mb-2">Sin historial de fases</h3>
                <p class="text-muted-foreground">Aún no hay registro de fases para este proyecto.</p>
            </div>
        @endif
    </div>
</div>
