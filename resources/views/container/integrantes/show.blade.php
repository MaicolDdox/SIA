@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">{{ $integrante->name }}</h1>
                <p class="text-muted-foreground">Detalles completos del Aprendiz integrado</p>
            </div>
        </div>

        <a href="{{ route('aprendices.index') }}"
           class="bg-muted hover:bg-muted/80 text-foreground px-4 py-2 rounded-lg font-medium
           transition-all duration-200 shadow-sm flex items-center space-x-2">
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
            <p class="text-xl text-foreground mb-2">
                <strong>Semillero:</strong> <span>{{ $integrante->dataUser->semillero_name ?? 'No selecciono semillero aun' }}</span>
                <strong>Proyecto:</strong>  <span>{{ $integrante->dataUser->proyecto_titulo ?? 'No escribio titulo de proyecto aun' }}</span>
            </p>
            <p class="text-muted-foreground leading-relaxed">
                {{ $integrante->dataUser->proyecto_descripccion ?? 'No se ha agregado una descripción.' }}
            </p>
        </div>

        {{-- Metadata --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-muted/30 rounded-lg p-4">
                <h3 class="text-sm font-medium text-muted-foreground">Fecha de creación</h3>
                <p class="text-foreground mt-1">{{ $integrante->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="bg-muted/30 rounded-lg p-4">
                <h3 class="text-sm font-medium text-muted-foreground">Última actualización</h3>
                <p class="text-foreground mt-1">{{ $integrante->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
