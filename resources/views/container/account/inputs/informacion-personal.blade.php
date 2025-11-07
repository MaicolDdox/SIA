{{-- informacion prsonal --}}
{{-- tipo de documento --}}
<div class="space-y-2">
    <label
        for="tipo_documento"
        class="text-sm font-medium text-foreground">
            Tipo de Documento
    </label>
    <select
        name="tipo_documento"
        id="tipo_documento"
            class="w-full
            rounded-md
            border
            border-border
            bg-background
            px-3
            py-2
            text-sm
            text-foreground
            focus:outline-none
            focus:ring-2
            focus:ring-primary
            focus:border-transparent">
            @foreach (['Registro Civil',
                    'Tarjeta de Identidad',
                    'Cédula de Ciudadanía',
                    'Cédula de Extranjería',
                    'Pasaporte',
                    'DNI'] as $opt)
                <option value="{{ $opt }}" @selected(optional($dataUser)->tipo_documento === $opt)>
                    {{ $opt }}
                </option>
            @endforeach
    </select>
    @error('tipo_documento')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Numero de documento --}}
<div class="space-y-2">
    <label
        for="numero_documento"
        class="text-sm font-medium text-foreground">
        Número de Documento
    </label>
    <input
        type="text"
        name="numero_documento"
        id="numero_documento"
        value="{{ old('numero_documento', optional($dataUser)->numero_documento) }}"
        placeholder="Ingresa tu número de documento"
        class="w-full
        rounded-md
        border
        border-border
        bg-background
        px-3 py-2 text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none focus:ring-2
        focus:ring-primary
        focus:border-transparent">
    @error('numero_documento')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- genero --}}
<div class="space-y-2">
    <label
        for="genero"
        class="text-sm font-medium text-foreground">
            Género
    </label>
    <input
        type="text"
        name="genero"
        id="genero"
        value="{{ old('genero', optional($dataUser)->genero) }}"
        placeholder="Masculino, Femenino, Otro"
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
    @error('genero')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Tipo de sangre --}}
<div class="space-y-2">
    <label for="rh"
        class="text-sm font-medium text-foreground">
            Tipo de Sangre (RH)
    </label>
    <input
        type="text"
        name="rh"
        id="rh"
        value="{{ old('rh', optional($dataUser)->rh) }}"
        placeholder="O+, A+, B+, AB+, O-, A-, B-, AB-"
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
    @error('rh')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- eps --}}
<div class="space-y-2">
    <label for="eps"
        class="text-sm font-medium text-foreground">
            EPS
    </label>
    <input type="text" name="eps" id="eps"
        value="{{ old('eps', optional($dataUser)->eps) }}"
        placeholder="Nombre de tu EPS"
        class="w-full rounded-md border
        border-border
        bg-background
        px-3
        py-2
        text-sm
        text-foreground
        placeholder:text-muted-foreground
        focus:outline-none
        focus:ring-2
        focus:ring-primary
        focus:border-transparent">
    @error('eps')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
