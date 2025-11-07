@extends('layouts.dashboard')
@section('content')
{{-- css de tombSelect.js --}}
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.default.min.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto">
        {{-- Aplicando header estandarizado SENA --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-foreground mb-2">Mis Datos Personales</h1>
                    <p class="text-muted-foreground">Completa tu información personal para el sistema CEFA</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aplicando mensaje de éxito estandarizado SENA --}}
        @if (session('success'))
            <div
                class="mb-6 bg-primary/10 border border-primary/20 text-primary px-4 py-3 rounded-lg flex items-center space-x-3">
                <svg
                    class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Aplicando diseño de card estandarizado SENA --}}
        <div class="bg-card rounded-lg shadow-sm border border-border overflow-visible">
            <div class="px-6 py-4 border-b border-border bg-muted/30">
                <h3 class="text-lg font-semibold text-foreground">Información Personal</h3>
                <p class="text-sm text-muted-foreground">Completa todos los campos requeridos</p>
            </div>

            <form action="{{ route('data_users.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- informacion personal --}}
                    @include('container.account.inputs.informacion-personal')

                    {{-- contacto --}}
                    @include('container.account.inputs.contacto')

                    {{-- informacion academica --}}
                    @include('container.account.inputs.informacion-academica')

                    {{-- componente file para pdf inscripccion --}}
                    @include('container.account.inputs.componente-file')


                {{-- Button --}}
                <div class="pt-6 border-t border-border flex justify-end">
                    <button
                        type="submit"
                        class="bg-primary hover:bg-primary/90
                        text-primary-foreground px-6 py-3
                        rounded-lg font-medium transition-colors
                        duration-200 flex items-center space-x-2">
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Guardar Datos Personales</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const select = document.querySelector("#semillero_name");
            if (!select) return;

            // Inicializamos TomSelect
            const tom = new TomSelect(select, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Buscar semillero por nombre...",
                searchField: ['text'],
                render: {
                    option: (data, escape) => `
                <div class="py-2 px-3 hover:bg-gray-100 cursor-pointer">
                    <div class="font-medium text-gray-800">${escape(data.text)}</div>
                </div>
            `,
                    item: (data, escape) => `<div>${escape(data.text)}</div>`
                }
            });

            // Aplica estilos a la caja TomSelect
            const wrapper = select.closest('.space-y-2').querySelector('.ts-wrapper');
            if (wrapper) {
                wrapper.classList.add(
                    'w-full',
                    'rounded-md',
                    'border',
                    'border-border',
                    'bg-background',
                    'px-3',
                    'py-2',
                    'text-sm',
                    'text-foreground',
                    'focus-within:ring-2',
                    'focus-within:ring-primary',
                    'focus-within:border-transparent'
                );
            }
        });
    </script>


    <script>
        function handleFileSelect(input) {
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
@endsection
