<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIA</title>
    <meta name="description" content="Sistema de Gestión de Semilleros de Investigación - SIA">

    <!-- ICONO DEL SENA -->
    <link rel="icon" href="{{ asset('img/logoTipo.png') }}" type="image/x-icon">

    <!-- SENA Design System fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:700|source-sans-pro:400,500,600"
        rel="stylesheet" />

    <!-- Tailwind CSS with SENA configuration -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles personalisados css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body class="min-h-screen login-gradient font-body antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Enhanced login card with SENA branding -->
            <div class="login-card rounded-2xl p-8 border border-white/20" data-aos="fade-up" data-aos-duration="800"
                data-aos-delay="100">
                <!-- SENA Logo and Branding -->
                <div class=" mb-8" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 floating-animation">
                        <img src="{{ asset('img/logoTipo.png') }}" alt="Logotipo" class="w-full h-full object-contain">
                    </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    </script>

    @fluxScripts
</body>

</html>
