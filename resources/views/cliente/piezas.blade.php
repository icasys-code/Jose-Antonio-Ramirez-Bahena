@extends('cliente.plantilla')

@section('title', 'Piezas - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Piezas Automotrices</h2>
            <p class="text-slate-600 text-lg max-w-3xl mx-auto">Encuentra repuestos originales y alternativos para todas las marcas. Calidad garantizada para mantener tu vehículo en marcha.</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-10 bg-slate-50 p-6 rounded-lg">
            <form method="GET" action="{{ route('piezas') }}" class="flex gap-3">
                <input 
                    type="text" 
                    name="search"
                    placeholder="Buscar pieza..." 
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
                    aria-label="Buscar piezas"
                >
                <button 
                    type="submit"
                    class="min-h-11 px-6 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 transition cursor-pointer"
                >
                    Buscar
                </button>
            </form>
        </div>

        <!-- Parts Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @forelse($parts as $part)
                @php
                    $img = $part->images ? $part->images->first() : null;
                    if ($img) {
                        $imgSrc = filter_var($img->path, FILTER_VALIDATE_URL) ? $img->path : asset('storage/' . $img->path);
                    } else {
                        $imgSrc = 'https://via.placeholder.com/400x300?text=' . urlencode($part->name ?? 'Pieza');
                    }
                    
                    $categoryName = $part->category ? $part->category->name : 'Sin categoría';
                    $manufacturerName = $part->manufacturer ? $part->manufacturer->name : 'Sin fabricante';
                @endphp

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative overflow-hidden bg-slate-200 h-56">
                        <img 
                            src="{{ $imgSrc }}" 
                            alt="{{ $part->name }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                        @if($part->price)
                            <div class="absolute top-3 right-3 bg-yellow-400 text-blue-900 px-3 py-1 rounded font-bold text-sm">
                                ${{ number_format($part->price ?? 0, 0) }}
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2">{{ $part->name ?? 'Pieza sin nombre' }}</h3>
                        <div class="space-y-2 mb-4">
                            <p class="text-slate-600 text-sm">
                                <span class="font-semibold">Categoría:</span> {{ $categoryName }}
                            </p>
                            <p class="text-slate-600 text-sm">
                                <span class="font-semibold">Fabricante:</span> {{ $manufacturerName }}
                            </p>
                            @if($part->description)
                                <p class="text-slate-600 text-sm line-clamp-2">{{ $part->description }}</p>
                            @endif
                        </div>
                        <button 
                            class="w-full min-h-10 px-4 py-2 bg-blue-900 text-white font-semibold rounded hover:bg-blue-800 transition cursor-pointer"
                            aria-label="Ver más detalles de {{ $part->name }}"
                        >
                            Ver detalles
                        </button>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-slate-600 text-lg">No hay piezas disponibles en este momento.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($parts->hasPages())
            <div class="flex justify-center">
                {{ $parts->withQueryString()->links() }}
            </div>
        @endif

        <!-- Categories Section -->
        <div class="mt-16 pt-12 border-t border-slate-200">
            <h3 class="text-2xl font-bold text-blue-900 mb-8 text-center">Categorías de Piezas</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#" class="group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer" aria-label="Ver categoría de motores">
                    <div class="text-4xl mb-4">🔧</div>
                    <h4 class="font-bold text-lg group-hover:text-yellow-400 transition">Motores</h4>
                    <p class="text-sm text-blue-100 mt-2">Motores y componentes</p>
                </a>
                
                <a href="#" class="group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer" aria-label="Ver categoría de frenos">
                    <div class="text-4xl mb-4">🛑</div>
                    <h4 class="font-bold text-lg group-hover:text-yellow-400 transition">Frenos</h4>
                    <p class="text-sm text-blue-100 mt-2">Sistema de frenado</p>
                </a>
                
                <a href="#" class="group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer" aria-label="Ver categoría de suspensión">
                    <div class="text-4xl mb-4">⚙️</div>
                    <h4 class="font-bold text-lg group-hover:text-yellow-400 transition">Suspensión</h4>
                    <p class="text-sm text-blue-100 mt-2">Amortiguadores y resortes</p>
                </a>
                
                <a href="#" class="group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer" aria-label="Ver categoría de accesorios">
                    <div class="text-4xl mb-4">🎁</div>
                    <h4 class="font-bold text-lg group-hover:text-yellow-400 transition">Accesorios</h4>
                    <p class="text-sm text-blue-100 mt-2">Accesorios y complementos</p>
                </a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a 
                href="{{ route('publicar') }}" 
                class="inline-flex items-center justify-center min-h-12 px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer transition"
            >
                ¿Tienes piezas que vender?
            </a>
        </div>
    </div>
</section>
@endsection
