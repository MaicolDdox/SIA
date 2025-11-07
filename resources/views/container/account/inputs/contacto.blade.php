{{-- telefono --}}
<div class="space-y-2">
    <label
        for="telefono"
        class="text-sm font-medium text-foreground">
            Teléfono
    </label>
    <input
        type="text"
        name="telefono"
        id="telefono"
        value="{{ old('telefono', optional($dataUser)->telefono) }}" placeholder="Número de teléfono"
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
    @error('telefono')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
