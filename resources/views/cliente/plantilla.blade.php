 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AutoPremium - Refaccionaria automotriz. Compra y vende vehículos y piezas automotrices de calidad.">
    <title>@yield('title', config('app.name', 'AutoPremium | Refaccionaria Automotriz'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #1e3a8a;
            --color-secondary: #0f172a;
            --color-accent: #eab308;
            --color-light: #f8fafc;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
        }
        
        /* Focus state for accessibility */
        button:focus-visible,
        a:focus-visible {
            outline: 3px solid var(--color-accent);
            outline-offset: 2px;
        }
        
        /* Smooth transitions */
        a, button {
            transition: all 200ms ease-out;
        }
        
        /* Hover effect for interactive elements */
        .interactive-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Image optimization */
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        
        /* Better button styles */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            min-width: 44px;
            padding: 0.75rem 1.5rem;
            background-color: var(--color-primary);
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: var(--color-secondary);
        }
        
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            min-width: 44px;
            padding: 0.75rem 1.5rem;
            background-color: var(--color-accent);
            color: var(--color-primary);
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }
        
        .btn-secondary:hover {
            background-color: #daa520;
        }
        
        /* Accessible color contrast */
        .text-muted {
            color: #475569;
        }
        
        .text-light-muted {
            color: #64748b;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header & Navigation -->
    <header class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0" aria-label="AutoPremium - Ir a inicio">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-slate-800 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">🚗</span>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-slate-900">AutoPremium</h1>
                        <p class="text-xs text-slate-500">Refaccionaria Automotriz</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8" role="navigation" aria-label="Navegación principal">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-700 hover:text-blue-900 cursor-pointer">Inicio</a>
                    <a href="{{ route('vehiculos') }}" class="text-sm font-medium text-slate-700 hover:text-blue-900 cursor-pointer">Vehículos</a>
                    <a href="{{ route('piezas') }}" class="text-sm font-medium text-slate-700 hover:text-blue-900 cursor-pointer">Piezas</a>
                    <a href="{{ route('nosotros') }}" class="text-sm font-medium text-slate-700 hover:text-blue-900 cursor-pointer">Nosotros</a>
                    <a href="{{ route('contacto') }}" class="text-sm font-medium text-slate-700 hover:text-blue-900 cursor-pointer">Contacto</a>
                </nav>

                <!-- CTA Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('publicar') }}" class="hidden sm:inline-flex btn-secondary text-sm">
                        <span>+ Publicar</span>
                    </a>
                    <button class="md:hidden p-2 cursor-pointer hover:bg-slate-100 rounded-lg" id="mobile-menu-btn" aria-expanded="false" aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobile-menu" class="hidden md:hidden pb-4" role="navigation" aria-label="Navegación móvil">
                <a href="{{ route('home') }}" class="block px-2 py-2 text-sm font-medium text-slate-700 hover:text-blue-900 hover:bg-slate-100 rounded cursor-pointer">Inicio</a>
                <a href="{{ route('vehiculos') }}" class="block px-2 py-2 text-sm font-medium text-slate-700 hover:text-blue-900 hover:bg-slate-100 rounded cursor-pointer">Vehículos</a>
                <a href="{{ route('piezas') }}" class="block px-2 py-2 text-sm font-medium text-slate-700 hover:text-blue-900 hover:bg-slate-100 rounded cursor-pointer">Piezas</a>
                <a href="{{ route('nosotros') }}" class="block px-2 py-2 text-sm font-medium text-slate-700 hover:text-blue-900 hover:bg-slate-100 rounded cursor-pointer">Nosotros</a>
                <a href="{{ route('contacto') }}" class="block px-2 py-2 text-sm font-medium text-slate-700 hover:text-blue-900 hover:bg-slate-100 rounded cursor-pointer">Contacto</a>
                <a href="{{ route('publicar') }}" class="block mt-2 px-2 py-2 text-sm font-medium btn-secondary text-center">+ Publicar</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span>🚗</span> AutoPremium
                    </h3>
                    <p class="text-sm text-slate-400">Refaccionaria automotriz dedicada a ofrecer vehículos y repuestos de calidad.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4">Navegación</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Inicio</a></li>
                        <li><a href="{{ route('vehiculos') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Vehículos</a></li>
                        <li><a href="{{ route('piezas') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Piezas</a></li>
                        <li><a href="{{ route('nosotros') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Nosotros</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-semibold mb-4">Soporte</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contacto') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Contacto</a></li>
                        <li><a href="{{ route('publicar') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Publicar</a></li>
                        <li><a href="{{ route('registro') }}" class="text-sm text-slate-400 hover:text-white cursor-pointer">Registrarse</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-semibold mb-4">Contacto</h4>
                    <p class="text-sm text-slate-400 mb-2">
                        <strong>Email:</strong> <a href="mailto:info@autopremium.com" class="text-yellow-400 hover:text-yellow-300 cursor-pointer">info@autopremium.com</a>
                    </p>
                    <p class="text-sm text-slate-400">
                        <strong>Teléfono:</strong> <a href="tel:+525512345678" class="text-yellow-400 hover:text-yellow-300 cursor-pointer">+52 55 1234 5678</a>
                    </p>
                </div>
            </div>

            <hr class="border-slate-800 mb-6">

            <!-- Copyright -->
            <div class="text-center text-sm text-slate-400">
                <p>&copy; 2026 AutoPremium - Refaccionaria Automotriz. Todos los derechos reservados.</p>
                <p class="mt-2">Proyecto ICASYS | Desarrollado con Laravel y Tailwind CSS</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.toggle('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', !isOpen);
            });
        }
    </script>
</body>
</html>
