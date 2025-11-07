{{-- tipo de programa --}}
<div class="space-y-2">
    <label
        for="tipo_programa"
        class="text-sm font-medium text-foreground">
            Tipo de Programa
    </label>
    <select
        name="tipo_programa"
        id="tipo_programa"
        class="w-full
        rounded-md border
        border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent">
        @foreach (['tecnico', 'tecnologo', 'complementaria'] as $opt)
            <option value="{{ $opt }}" @selected(optional($dataUser)->tipo_programa === $opt)>
                {{ ucfirst($opt) }}
            </option>
        @endforeach
    </select>
    @error('tipo_programa')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- programa de formacion --}}
<div class="space-y-2">
    <label
        for="programa_formacion"
        class="text-sm font-medium text-foreground">
            Programa de Formación
    </label>
    <input
        type="text"
        name="programa_formacion"
        id="programa_formacion"
        value="{{ old('programa_formacion', optional($dataUser)->programa_formacion) }}"
        placeholder="Nombre del programa de formación"
        class="w-full
        rounded-md border
        border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none focus:ring-2
        focus:ring-primary
        focus:border-transparent">
    @error('programa_formacion')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- ficha de programa --}}
<div class="space-y-2">
    <label
        for="ficha_programa"
        class="text-sm font-medium text-foreground">
            Ficha del Programa
    </label>
    <input
        type="text"
        name="ficha_programa"
        id="ficha_programa"
        value="{{ old('ficha_programa', optional($dataUser)->ficha_programa) }}"
        placeholder="Número de ficha"
        class="w-full
        rounded-md
        border
        border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent">
    @error('ficha_programa')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- apoyos --}}
<div class="space-y-2">
    <label
        for="apoyos"
        class="text-sm font-medium text-foreground">
            Apoyos
    </label>
    <input
        type="text"
        name="apoyos"
        id="apoyos"
        value="{{ old('apoyos', optional($dataUser)->apoyos) }}" placeholder="Apoyos recibidos"
        class="w-full
        rounded-md
        border border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent">
    @error('apoyos')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

@if (auth()->user()->can('datos_extra_aprendiz_integrado')  ||
auth()->user()->can('datos_extra_instructor_integrado') ||
auth()->user()->roles->isEmpty())
{{-- semillero --}}
<div class="space-y-2">
    <label
    for="semillero_name"
    class="text-sm font-medium text-foreground">
            Semillero
    </label>
    <select
        name="semillero_name"
        id="semillero_name"
        class="w-full
        rounded-md border
        border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent">
        <option value="">Seleccione un Semillero</option>
        @foreach ($semilleros as $semillero)
            <option value="{{ $semillero->titulo }}" @selected(optional($dataUser)->semillero_name === $semillero->titulo)>
                {{ $semillero->titulo  }}
            </option>
            @endforeach
        </select>
        @error('semillero_name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
</div>

{{-- titulo de poryecto --}}
<div class="space-y-2">
    <label
    for="proyecto_titulo"
    class="text-sm font-medium text-foreground">
    Titulo Proyecto
</label>
<input
    type="text"
    name="proyecto_titulo"
    id="proyecto_titulo"
    value="{{ old('proyecto_titulo', optional($dataUser)->proyecto_titulo) }}"
    placeholder="Titulo de tu proyecto"
    class="w-full
    rounded-md
    border border-border
    bg-background
    px-3 py-2 text-sm
    text-foreground
    placeholder:text-muted-foreground
    focus:outline-none
    focus:ring-2
    focus:ring-primary
    focus:border-transparent">
    @error('proyecto_titulo')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- descripccion de proyecto --}}
<div class="space-y-2 md:col-span-2">
    <label
    for="proyecto_descripccion"
    class="text-sm font-medium text-foreground">
    Descripción del Proyecto
</label>
<textarea
        name="proyecto_descripccion"
        id="proyecto_descripccion"
        rows="5"
        placeholder="Describe brevemente tu proyecto..."
        class="w-full
        rounded-md
        border border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent
        resize-y">{{ old('proyecto_descripccion', optional($dataUser)->proyecto_descripccion) }}</textarea>
        @error('proyecto_descripccion')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
@endif
