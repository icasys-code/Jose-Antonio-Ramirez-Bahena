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
                                ${{{ number_format($part->price ?? 0, 0) }}}
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
                            class="w-full min-h-10 px-4 py-2 bg-blue-900 text-white font-semibold rounded hover:bg-blue-800 transition cursor-pointer\"\n                            aria-label=\"Ver más detalles de {{ $part->name }}\"\n                        >\n                            Ver detalles\n                        </button>\n                    </div>\n                </div>\n            @empty\n                <div class=\"md:col-span-3 bg-white rounded-lg shadow-md p-12 text-center\">\n                    <p class=\"text-slate-600 text-lg\">No hay piezas disponibles en este momento.</p>\n                </div>\n            @endforelse\n        </div>\n\n        <!-- Pagination -->\n        @if($parts->hasPages())\n            <div class=\"flex justify-center\">\n                {{ $parts->links() }}\n            </div>\n        @endif\n\n        <!-- Categories Section -->\n        <div class=\"mt-16 pt-12 border-t border-slate-200\">\n            <h3 class=\"text-2xl font-bold text-blue-900 mb-8 text-center\">Categorías de Piezas</h3>\n            <div class=\"grid md:grid-cols-2 lg:grid-cols-4 gap-6\">\n                <a href=\"#\" class=\"group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer\" aria-label=\"Ver categoría de motores\">\n                    <div class=\"text-4xl mb-4\">🔧</div>\n                    <h4 class=\"font-bold text-lg group-hover:text-yellow-400 transition\">Motores</h4>\n                    <p class=\"text-sm text-blue-100 mt-2\">Motores y componentes</p>\n                </a>\n                \n                <a href=\"#\" class=\"group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer\" aria-label=\"Ver categoría de frenos\">\n                    <div class=\"text-4xl mb-4\">🛑</div>\n                    <h4 class=\"font-bold text-lg group-hover:text-yellow-400 transition\">Frenos</h4>\n                    <p class=\"text-sm text-blue-100 mt-2\">Sistema de frenado</p>\n                </a>\n                \n                <a href=\"#\" class=\"group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer\" aria-label=\"Ver categoría de suspensión\">\n                    <div class=\"text-4xl mb-4\">⚙️</div>\n                    <h4 class=\"font-bold text-lg group-hover:text-yellow-400 transition\">Suspensión</h4>\n                    <p class=\"text-sm text-blue-100 mt-2\">Amortiguadores y resortes</p>\n                </a>\n                \n                <a href=\"#\" class=\"group block min-h-32 bg-blue-900 text-white p-6 rounded-lg hover:bg-blue-800 transition-all shadow-md hover:shadow-lg cursor-pointer\" aria-label=\"Ver categoría de accesorios\">\n                    <div class=\"text-4xl mb-4\">🎁</div>\n                    <h4 class=\"font-bold text-lg group-hover:text-yellow-400 transition\">Accesorios</h4>\n                    <p class=\"text-sm text-blue-100 mt-2\">Accesorios y complementos</p>\n                </a>\n            </div>\n        </div>\n\n        <div class=\"mt-12 text-center\">\n            <a \n                href=\"{{ route('publicar') }}\" \n                class=\"inline-flex items-center justify-center min-h-12 px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer transition\"\n            >\n                ¿Tienes piezas que vender?\n            </a>\n        </div>\n    </div>\n</section>\n@endsection
