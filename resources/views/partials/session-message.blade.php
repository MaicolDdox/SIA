{{-- Mensajes de éxito --}}
@if (session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 4000)"
    class="mb-6 bg-primary/10 border border-primary/20 text-primary px-4 py-4 rounded-lg"
>
    <div class="flex items-start space-x-3">
        <svg
            class="w-5 h-5 flex-shrink-0 mt-0.5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18
                0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif


{{-- mensaje de error --}}
@if (session('error'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 4000)"
    class="mb-6 bg-red-100/80 border border-red-300/60 text-red-700 px-4 py-4 rounded-lg"
>
    <div class="flex items-start space-x-3">
        <svg
            class="w-5 h-5 flex-shrink-0 mt-0.5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14
                7 7 0 000-14z" />
        </svg>
        <div>
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

