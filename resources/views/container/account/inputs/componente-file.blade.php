{{-- Aplicando componente de file upload estandarizado --}}
    <div class="space-y-2 md:col-span-2">
        <label class="text-sm font-medium text-foreground">
            Formato de Registro (PDF)
        </label>
        <div class="relative">
            <input
                type="file"
                name="formato_registro"
                accept=".pdf"
                class="absolute inset-0 w-full h-full
                opacity-0 cursor-pointer z-10"
                onchange="handleFileSelect(this)">
            <div
                class="border-2 border-dashed border-border
                hover:border-primary/50 rounded-lg p-6 bg-muted/30
                hover:bg-primary/5 transition-colors duration-200
                text-center">
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0
                                01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-foreground">Seleccionar formato de registro</p>
                        <p class="text-xs text-muted-foreground">Solo archivos PDF</p>
                    </div>
                </div>
                <div
                    class="hidden mt-4 p-3 bg-primary/10 border
                    border-primary/20 rounded-lg"
                    data-file-info>
                    <div class="flex items-center space-x-2">
                        <svg
                            class="w-4 h-4 text-primary flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-primary truncate" data-file-name></p>
                            <p class="text-xs text-primary/70" data-file-size></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (optional($dataUser)->formato_registro)
            <div class="mt-3 p-3 bg-secondary border border-border rounded-lg">
                <div class="flex items-center space-x-2">
                    <svg
                        class="w-4 h-4 text-muted-foreground"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1
                            1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <a
                        href="{{ Storage::url($dataUser->formato_registro) }}"
                        target="_blank"
                        class="text-sm font-medium text-foreground
                        hover:text-primary transition-colors duration-200">
                        Ver archivo actual
                    </a>
                </div>
            </div>
        @endif
        @error('formato_registro')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
