@error('email')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
@error('password')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
<div>
    <!-- Enhanced auth header with better styling -->
    <div class="text-center mb-6" data-aos="fade-down" data-aos-duration="600" data-aos-delay="500">
        <h2 class="text-xl font-semibold text-foreground mb-2">Iniciar Sesión</h2>
        <p class="text-sm text-muted-foreground">Ingresa tus credenciales para acceder al sistema</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <!-- Enhanced login form with improved styling -->
    <form method="POST" wire:submit="login" class="space-y-6" data-aos="fade-up" data-aos-duration="700"
        data-aos-delay="700">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-foreground mb-2">
                Correo Electrónico
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input wire:model="email" type="email" id="email" required autofocus autocomplete="email"
                    placeholder="correo@ejemplo.com"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-foreground mb-2">
                Contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input wire:model="password" type="password" id="password" required autocomplete="current-password"
                    placeholder="Ingresa tu contraseña"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />

            </div>
        </div>

        <!-- Enhanced submit button with SENA styling -->
        <button type="submit"
            class="w-full
            bg-emerald-100
            hover:bg-primary/90
            text-gray-500
            font-semibold
            py-3
            px-4
            rounded-lg
            transition-all
            duration-200
            transform
            hover:scale-[1.02]
            focus:outline-none
            focus:ring-2
            focus:ring-primary
            focus:ring-offset-2"
            data-aos="zoom-in"
            data-aos-duration="600"
            data-aos-delay="1500">
            Iniciar Sesión
        </button>
    </form>
    <!-- Enhanced login link with SENA styling -->
    <div class="mt-6 text-center" data-aos="fade-up" data-aos-duration="500" data-aos-delay="1900">
        <p class="text-sm text-muted-foreground">
            ¿No tienes una cuenta?
            <a href="{{ route('register') }}" wire:navigate
                class="text-primary hover:text-primary/80 font-medium transition-colors duration-200">
                Registrarse
            </a>
        </p>
        <p class="text-sm text-muted-foreground">
            ¿Quieres regresar?
            <a href="{{ route('home') }}" wire:navigate class="text-primary hover:text-primary/80 font-medium transition-colors duration-200">
                Home
            </a>
        </p>
    </div>
</div>
