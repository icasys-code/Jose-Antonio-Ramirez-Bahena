<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrador - Refaccionaria')</title>
    <!-- Google Fonts Fira Sans / Fira Code -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&family=Fira+Code:wght@400;500;600&display=swap');
        body {
            font-family: 'Fira Sans', sans-serif;
        }
        code, pre {
            font-family: 'Fira Code', monospace;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f5f6ff',
                            100: '#ebedff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            950: '#020617'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50/50 text-slate-800 min-h-screen flex flex-col md:flex-row antialiased">

    @php
        // Active Route Group Flags
        $catalogActive = request()->routeIs('admin.attributes.*', 'admin.attributevalues.*', 'admin.brands.*', 'admin.carmodels.*', 'admin.carvariants.*', 'admin.categories.*', 'admin.components.*', 'admin.componentparts.*', 'admin.manufacturers.*', 'admin.parts.*', 'admin.partvariants.*');
        $compatibilityActive = request()->routeIs('admin.vehicles.*');
        $inventoryActive = request()->routeIs('admin.stocks.*', 'admin.warehouses.*', 'admin.vendors.*', 'admin.pricehistorys.*');
        $salesActive = request()->routeIs('admin.orders.*', 'admin.orderitems.*', 'admin.users.*', 'admin.images.*');

        // Dynamic Breadcrumbs Name Mapping
        $routeName = request()->route() ? request()->route()->getName() : 'admin.dashboard';
        $routeParts = explode('.', $routeName);
        $namesMap = [
            'dashboard' => 'Dashboard',
            'attributes' => 'Atributos',
            'attributevalues' => 'Valores de Atributos',
            'brands' => 'Marcas',
            'carmodels' => 'Modelos de Autos',
            'carvariants' => 'Variantes de Autos',
            'categories' => 'Categorías',
            'components' => 'Componentes',
            'componentparts' => 'Partes de Componentes',
            'images' => 'Imágenes',
            'manufacturers' => 'Fabricantes',
            'orders' => 'Órdenes',
            'orderitems' => 'Ítems de Órdenes',
            'parts' => 'Piezas',
            'partvariants' => 'Variantes de Piezas',
            'pricehistorys' => 'Historial de Precios',
            'stocks' => 'Inventario / Stock',
            'users' => 'Usuarios',
            'vehicles' => 'Vehículos',
            'vendors' => 'Proveedores',
            'warehouses' => 'Almacenes',
            'index' => 'Listado',
            'create' => 'Crear Nuevo',
            'edit' => 'Editar',
            'show' => 'Detalle',
        ];
    @endphp

    <!-- Mobile Header -->
    <header class="md:hidden bg-slate-950 text-white p-4 flex items-center justify-between border-b border-slate-900 sticky top-0 z-30 shadow-md">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-600/10 border border-indigo-500/20 text-indigo-400 rounded-xl">
                <i data-lucide="wrench" class="w-5 h-5"></i>
            </div>
            <div>
                <h1 class="font-bold text-sm tracking-tight leading-none text-slate-100">Refaccionaria</h1>
                <span class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Panel Admin</span>
            </div>
        </div>
        <button onclick="toggleSidebar()" class="p-2 bg-slate-900 border border-slate-800 text-slate-400 hover:text-white rounded-xl cursor-pointer">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
    </header>

    <!-- Sidebar Layout -->
    <aside id="sidebar" class="hidden md:flex w-full md:w-72 bg-slate-950 text-slate-100 flex-col border-r border-slate-900 shadow-xl flex-shrink-0 z-20 sticky top-0 h-screen overflow-y-auto">
        <!-- Brand identity -->
        <div class="px-6 py-5 border-b border-slate-900 flex items-center gap-3">
            <div class="p-2.5 bg-indigo-600 text-white rounded-xl shadow-sm shadow-indigo-600/20">
                <i data-lucide="wrench" class="w-5 h-5"></i>
            </div>
            <div>
                <h1 class="font-bold text-base tracking-tight leading-none text-slate-100">Refaccionaria</h1>
                <span class="text-[10px] text-slate-500 font-bold tracking-wider uppercase mt-1 block">Panel Administrador</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-4">
            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'text-white bg-indigo-600 shadow-sm shadow-indigo-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-900' }} transition-all duration-200 cursor-pointer">
                <i data-lucide="home" class="w-4 h-4"></i> Dashboard
            </a>

            <!-- Group: Catalog -->
            <div class="space-y-1">
                <button onclick="toggleGroup('catalog')" class="w-full flex items-center justify-between px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-200 transition-colors focus:outline-none cursor-pointer">
                    <span class="flex items-center gap-2.5"><i data-lucide="grid-3x3" class="w-4 h-4"></i> Catálogo Refacciones</span>
                    <i data-lucide="chevron-down" id="catalog-chevron" class="w-3.5 h-3.5 transition-transform duration-200 {{ $catalogActive ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="catalog-items" class="pl-3 space-y-1 mt-1 {{ $catalogActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.parts.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.parts.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="wrench" class="w-3.5 h-3.5"></i> Piezas (Wrench)
                    </a>
                    <a href="{{ route('admin.partvariants.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.partvariants.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="layers" class="w-3.5 h-3.5"></i> Variantes de Piezas
                    </a>
                    <a href="{{ route('admin.components.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.components.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="cpu" class="w-3.5 h-3.5"></i> Componentes
                    </a>
                    <a href="{{ route('admin.componentparts.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.componentparts.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="puzzle" class="w-3.5 h-3.5"></i> Partes de Componentes
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.categories.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="folder-git" class="w-3.5 h-3.5"></i> Categorías
                    </a>
                    <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.brands.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="bookmark" class="w-3.5 h-3.5"></i> Marcas
                    </a>
                    <a href="{{ route('admin.manufacturers.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.manufacturers.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="factory" class="w-3.5 h-3.5"></i> Fabricantes
                    </a>
                    <a href="{{ route('admin.attributes.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.attributes.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="list" class="w-3.5 h-3.5"></i> Atributos
                    </a>
                    <a href="{{ route('admin.attributevalues.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.attributevalues.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5"></i> Valores Atributos
                    </a>
                </div>
            </div>

            <!-- Group: Compatibility -->
            <div class="space-y-1">
                <button onclick="toggleGroup('compatibility')" class="w-full flex items-center justify-between px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-200 transition-colors focus:outline-none cursor-pointer">
                    <span class="flex items-center gap-2.5"><i data-lucide="car" class="w-4 h-4"></i> Compatibilidad</span>
                    <i data-lucide="chevron-down" id="compatibility-chevron" class="w-3.5 h-3.5 transition-transform duration-200 {{ $compatibilityActive ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="compatibility-items" class="pl-3 space-y-1 mt-1 {{ $compatibilityActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.vehicles.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="car-front" class="w-3.5 h-3.5"></i> Vehículos
                    </a>
                    <a href="{{ route('admin.carmodels.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.carmodels.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="compass" class="w-3.5 h-3.5"></i> Modelos de Autos
                    </a>
                    <a href="{{ route('admin.carvariants.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.carvariants.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="settings" class="w-3.5 h-3.5"></i> Variantes de Autos
                    </a>
                </div>
            </div>

            <!-- Group: Inventory -->
            <div class="space-y-1">
                <button onclick="toggleGroup('inventory')" class="w-full flex items-center justify-between px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-200 transition-colors focus:outline-none cursor-pointer">
                    <span class="flex items-center gap-2.5"><i data-lucide="package" class="w-4 h-4"></i> Inventario e Historial</span>
                    <i data-lucide="chevron-down" id="inventory-chevron" class="w-3.5 h-3.5 transition-transform duration-200 {{ $inventoryActive ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="inventory-items" class="pl-3 space-y-1 mt-1 {{ $inventoryActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.stocks.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.stocks.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="package-open" class="w-3.5 h-3.5"></i> Stock / Inventario
                    </a>
                    <a href="{{ route('admin.warehouses.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.warehouses.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="warehouse" class="w-3.5 h-3.5"></i> Almacenes
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.vendors.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="truck" class="w-3.5 h-3.5"></i> Proveedores
                    </a>
                    <a href="{{ route('admin.pricehistorys.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.pricehistorys.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i> Historial Precios
                    </a>
                </div>
            </div>

            <!-- Group: Sales/Operations -->
            <div class="space-y-1">
                <button onclick="toggleGroup('sales')" class="w-full flex items-center justify-between px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-200 transition-colors focus:outline-none cursor-pointer">
                    <span class="flex items-center gap-2.5"><i data-lucide="shopping-bag" class="w-4 h-4"></i> Ventas y Control</span>
                    <i data-lucide="chevron-down" id="sales-chevron" class="w-3.5 h-3.5 transition-transform duration-200 {{ $salesActive ? 'rotate-180' : '' }}"></i>
                </button>
                <div id="sales-items" class="pl-3 space-y-1 mt-1 {{ $salesActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.orders.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i> Órdenes
                    </a>
                    <a href="{{ route('admin.orderitems.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.orderitems.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i> Ítems de Órdenes
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.users.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i> Usuarios
                    </a>
                    <a href="{{ route('admin.images.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[11px] font-semibold {{ request()->routeIs('admin.images.*') ? 'text-white bg-slate-900 border-l-2 border-indigo-500 pl-2.5' : 'text-slate-400 hover:text-white hover:bg-slate-900/50' }} transition-all cursor-pointer">
                        <i data-lucide="image" class="w-3.5 h-3.5"></i> Imágenes
                    </a>
                </div>
            </div>
        </nav>

        <!-- Sidebar footer -->
        <div class="px-6 py-4 border-t border-slate-900 text-slate-500 text-[10px] font-medium tracking-wide">
            Acceso libre sin middleware Auth
        </div>
    </aside>

    <!-- Main Workspace -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Workspace Header -->
        <header class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between sticky top-0 z-10 shadow-sm shadow-slate-100/10">
            <!-- Breadcrumbs Navigation -->
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                <span class="hover:text-slate-600 transition-colors">Refaccionaria Admin</span>
                @foreach($routeParts as $part)
                    @if($part !== 'admin')
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                        <span class="{{ $loop->last ? 'text-indigo-600 font-bold' : 'hover:text-slate-600 transition-colors' }}">
                            {{ $namesMap[$part] ?? ucfirst($part) }}
                        </span>
                    @endif
                @endforeach
            </div>

            <!-- Info stats badge -->
            <div class="hidden sm:flex items-center gap-2 bg-slate-50 border border-slate-100 rounded-xl px-3.5 py-1.5 text-slate-600 text-[10px] font-bold uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Sistema Activo
            </div>
        </header>

        <!-- Main Content Section -->
        <section class="flex-1 p-6 md:p-8 space-y-6 overflow-y-auto">
            @yield('content')
        </section>
    </main>

    <!-- UI/UX Scripts -->
    <script>
        // Collapsible group logic
        function toggleGroup(id) {
            const items = document.getElementById(id + '-items');
            const chevron = document.getElementById(id + '-chevron');
            if (items.classList.contains('hidden')) {
                items.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                items.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        // Mobile responsive sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('flex');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('flex');
            }
        }

        // Initialize gorgeous Lucide Vector Icons
        lucide.createIcons();
    </script>
</body>
</html>
