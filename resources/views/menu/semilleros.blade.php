<!-- Semilleros Section -->

<div class="mb-6">
    <h3 class="sidebar-section-title text-xs font-semibold text-muted-foreground uppercase tracking-wider mb-3">
        Semilleros
    </h3>
    <ul class="space-y-1">

            <li>
                <a href="{{ route('semilleros.index') }}"
                    class="sidebar-item flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('semilleros.index') ? 'active' : 'text-muted-foreground hover:text-foreground' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Ver Semilleros
                </a>
            </li>

        <!--
            =============================================================
            MENU PARA PODER AGREGAR UNA SECCION PARA CREAR LOS SEMILLEROS
            DESCOMENTAR PARA PODER ACTIVARLO
            =============================================================

            @can('semilleros.create')
    <li>
                        <a href="{{ route('semilleros.create') }}"
                            class="sidebar-item flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('semilleros.create') ? 'active' : 'text-muted-foreground hover:text-foreground' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Crear Semillero
                        </a>
                    </li>
@endcan
            -->
    </ul>
</div>
