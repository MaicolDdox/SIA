{{-- Componente de carga de archivos --}}
@props([
    'name' => 'documento',
    'accept' => '.pdf,.doc,.docx',
    'required' => false,
    'label' => 'Seleccionar archivo', // Nuevo texto superior
    'hint' => 'PDF, DOC, DOCX, XLS, CSV, ZIP, RAR, 7z' // Descripción de tipos
])


<div class="relative group">
    <input type="file"
           name="{{ $name }}"
           accept="{{ $accept }}"
           {{ $required ? 'required' : '' }}
           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
           onchange="handleInlineFileSelect(this)">

    <div class="border-2 border-dashed border-border hover:border-primary/50 rounded-lg p-4 bg-muted/10 hover:bg-muted/20 transition-all duration-300 text-center group-hover:scale-[1.02]">
        <div class="flex items-center justify-center space-x-3">
            {{-- Icono de archivo --}}
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-300">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            {{-- Texto --}}
            <div class="text-left">
                <p class="text-sm font-medium text-foreground">{{ $label }}</p>
                <p class="text-xs text-muted-foreground">{{ $hint }}</p>
            </div>


            {{-- Icono de subida --}}
            <div class="w-8 h-8 bg-primary/5 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
            </div>
        </div>

        {{-- Información de archivo seleccionado --}}
        <div class="hidden mt-3 p-2 bg-primary/10 border border-primary/20 rounded-lg" data-file-info>
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-primary truncate" data-file-name></p>
                    <p class="text-xs text-primary/70" data-file-size></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleInlineFileSelect(input) {
    const container = input.closest('.relative');
    const fileInfo = container.querySelector('[data-file-info]');
    const fileName = container.querySelector('[data-file-name]');
    const fileSize = container.querySelector('[data-file-size]');
    const dropZone = container.querySelector('.border-dashed');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        fileInfo.classList.remove('hidden');
        dropZone.classList.add('border-primary', 'bg-primary/5');
        dropZone.classList.remove('border-border');
    } else {
        fileInfo.classList.add('hidden');
        dropZone.classList.remove('border-primary', 'bg-primary/5');
        dropZone.classList.add('border-border');
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
</script>
