@extends('administrador.plantilla')

@section('title', 'Dashboard - Panel Administrador')

@section('content')
<!-- Hero Welcome Section with Premium Gradient -->
<div class="relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-950 text-white rounded-3xl p-8 border border-slate-900 shadow-xl overflow-hidden mb-8">
    <div class="relative z-10 max-w-2xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-400/20 mb-4 uppercase tracking-wider">
            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span> Panel de Control
        </span>
        <h2 class="text-3xl font-extrabold tracking-tight md:text-4xl text-slate-100">
            Administración de Refaccionaria
        </h2>
        <p class="mt-3 text-slate-300 text-sm md:text-base leading-relaxed">
            Bienvenido al centro de operaciones. Desde este panel podrá gestionar el catálogo de piezas automotrices, compatibilidades de vehículos, almacenes, inventario y órdenes en tiempo real, sin requerir autenticación.
        </p>
    </div>
    <!-- Decorative background elements -->
    <div class="absolute -right-10 -bottom-10 opacity-10 text-white">
        <i data-lucide="wrench" class="w-64 h-64"></i>
    </div>
</div>

<!-- KPI Metrics Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card: Vehicles -->
    <div class="bg-white border border-slate-100 hover:border-indigo-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-44">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Flota</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1">Vehículos</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Inventario de autos y compatibilidad</p>
            </div>
            <div class="p-3 bg-sky-50 border border-sky-100 text-sky-600 rounded-xl">
                <i data-lucide="car-front" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-600 hover:text-sky-700 bg-sky-50 hover:bg-sky-100 px-3.5 py-2 rounded-xl transition-all cursor-pointer">
                Ver Catálogo <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- Card: Parts -->
    <div class="bg-white border border-slate-100 hover:border-indigo-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-44">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Catálogo</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1">Piezas</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Refacciones y componentes activos</p>
            </div>
            <div class="p-3 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl">
                <i data-lucide="wrench" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('admin.parts.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3.5 py-2 rounded-xl transition-all cursor-pointer">
                Ver Inventario <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- Card: Orders -->
    <div class="bg-white border border-slate-100 hover:border-indigo-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-44">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ventas</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1">Órdenes</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pedidos y transacciones recibidas</p>
            </div>
            <div class="p-3 bg-amber-50 border border-amber-100 text-amber-600 rounded-xl">
                <i data-lucide="clipboard-list" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 px-3.5 py-2 rounded-xl transition-all cursor-pointer">
                Ver Órdenes <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- Card: Users -->
    <div class="bg-white border border-slate-100 hover:border-indigo-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-44">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Cuentas</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1">Usuarios</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Cuentas de clientes y administradores</p>
            </div>
            <div class="p-3 bg-rose-50 border border-rose-100 text-rose-600 rounded-xl">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 px-3.5 py-2 rounded-xl transition-all cursor-pointer">
                Ver Cuentas <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>
</div>

<!-- Detailed Directory Card -->
<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden mb-6">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2"><i data-lucide="layers" class="w-5 h-5 text-indigo-500"></i> Resumen de Entidades en el Sistema</h3>
            <p class="text-xs text-slate-500 mt-0.5">Acceso rápido a todas las bases de datos de Refaccionaria.</p>
        </div>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-slate-50 text-slate-600 border border-slate-100 uppercase tracking-wider">
            20 Módulos de Datos
        </span>
    </div>
    
    <div class="p-6 bg-slate-50/50">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Catalog Links block -->
            <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all">
                <div class="flex items-center gap-2 mb-3 text-slate-400"><i data-lucide="grid-3x3" class="w-4 h-4"></i><span class="text-[10px] font-bold uppercase tracking-wider">Catálogo</span></div>
                <ul class="space-y-1.5">
                    <li><a href="{{ route('admin.parts.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Piezas</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Categorías</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.brands.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Marcas</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.attributes.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Atributos</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                </ul>
            </div>

            <!-- Compatibility block -->
            <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all">
                <div class="flex items-center gap-2 mb-3 text-slate-400"><i data-lucide="car" class="w-4 h-4"></i><span class="text-[10px] font-bold uppercase tracking-wider">Compatibilidad</span></div>
                <ul class="space-y-1.5">
                    <li><a href="{{ route('admin.vehicles.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Vehículos</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.carmodels.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Modelos de Auto</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.carvariants.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Variantes de Auto</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                </ul>
            </div>

            <!-- Inventory block -->
            <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all">
                <div class="flex items-center gap-2 mb-3 text-slate-400"><i data-lucide="package" class="w-4 h-4"></i><span class="text-[10px] font-bold uppercase tracking-wider">Inventario</span></div>
                <ul class="space-y-1.5">
                    <li><a href="{{ route('admin.stocks.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Stock</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.warehouses.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Almacenes</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.vendors.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Proveedores</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                </ul>
            </div>

            <!-- Control block -->
            <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all">
                <div class="flex items-center gap-2 mb-3 text-slate-400"><i data-lucide="shopping-bag" class="w-4 h-4"></i><span class="text-[10px] font-bold uppercase tracking-wider">Ventas y Control</span></div>
                <ul class="space-y-1.5">
                    <li><a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Órdenes</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.orderitems.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Ítems Órdenes</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                    <li><a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-slate-700 hover:text-indigo-600 flex items-center justify-between"><span>Usuarios</span><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection