<div>
    <!-- Enhanced auth header with SENA styling and animations -->
    <div class="text-center mb-6" data-aos="fade-down" data-aos-duration="600" data-aos-delay="500">
        <h2 class="text-xl font-semibold text-foreground mb-2">Crear Cuenta</h2>
        <p class="text-sm text-muted-foreground">Ingresa tus datos para crear tu cuenta en el sistema CEFA</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <!-- Enhanced register form with SENA styling, icons and animations -->
    <form method="POST" wire:submit="register" class="space-y-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">

        <!-- Name -->
        <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="900">
            <label for="name" class="block text-sm font-medium text-foreground mb-2">
                Nombre Completo
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input wire:model="name" type="text" id="name" required autofocus autocomplete="name"
                    placeholder="Ingresa tu nombre completo"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="1100">
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
                <input wire:model="email" type="email" id="email" required autocomplete="email"
                    placeholder="correo@ejemplo.com"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="1300">
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
                <input wire:model="password" type="password" id="password" required autocomplete="new-password"
                    placeholder="Crea una contraseña segura"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Confirm Password -->
        <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="1500">
            <label for="password_confirmation" class="block text-sm font-medium text-foreground mb-2">
                Confirmar Contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirma tu contraseña"
                    class="input-focus w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none" />
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Enhanced submit button with SENA styling and animation -->
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
            data-aos-delay="1700">
            Crear Cuenta
        </button>
    </form>

    <!-- Enhanced login link with SENA styling -->
    <div class="mt-6 text-center" data-aos="fade-up" data-aos-duration="500" data-aos-delay="1900">
        <p class="text-sm text-muted-foreground">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" wire:navigate class="text-primary hover:text-primary/80 font-medium transition-colors duration-200">
                Iniciar Sesión
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
