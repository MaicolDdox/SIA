{{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            {{-- Avatar de la imagen --}}
            <div class="shrink-0">
                @if($semillero->imagen)
                    <img src="{{ asset('storage/' . $semillero->imagen) }}"
                         alt="Imagen del semillero"
                         class="w-20 h-20 rounded-full object-cover border-2 border-muted shadow-md">
                @else
                    <div class="w-20 h-20 rounded-full bg-muted flex items-center justify-center text-2xl font-bold text-muted-foreground shadow-md">
                        {{ strtoupper(substr($semillero->titulo, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">{{ $semillero->titulo }}</h1>
                <p class="text-muted-foreground">Detalles completos del semillero de investigación</p>
            </div>
        </div>

        <a href="{{ route('semilleros.index') }}"
           class="bg-muted hover:bg-muted/80 text-foreground px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-sm flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Volver</span>
        </a>
    </div>

    {{-- Card principal --}}
    <div class="bg-card rounded-lg shadow-sm border border-border p-6 space-y-6">
        {{-- Información básica --}}
        <div>
            <h2 class="text-xl font-semibold text-foreground mb-2">Descripción</h2>
            <p class="text-muted-foreground leading-relaxed">
                {{ $semillero->descripcion ?? 'No se ha agregado una descripción.' }}
            </p>
        </div>

        {{-- Metadata --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-muted/30 rounded-lg p-4">
                <h3 class="text-sm font-medium text-muted-foreground">Fecha de creación</h3>
                <p class="text-foreground mt-1">{{ $semillero->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="bg-muted/30 rounded-lg p-4">
                <h3 class="text-sm font-medium text-muted-foreground">Última actualización</h3>
                <p class="text-foreground mt-1">{{ $semillero->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
