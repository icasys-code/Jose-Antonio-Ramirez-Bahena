@extends('cliente.plantilla')

@section('title', 'AutoPremium | Inicio')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 items-center gap-8 md:gap-12">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Encuentra tu <span class="text-yellow-400">Vehículo Ideal</span>
                </h2>
                <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                    Compra vehículos y piezas automotrices de calidad garantizada. Seguridad, confianza y los mejores precios del mercado.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a 
                        href="{{ route('vehiculos') }}" 
                        class="inline-flex items-center justify-center min-h-12 px-6 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer"
                        aria-label="Ver catálogo de vehículos"
                    >
                        Ver Vehículos
                    </a>
                    <a 
                        href="{{ route('piezas') }}" 
                        class="inline-flex items-center justify-center min-h-12 px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-900 cursor-pointer"
                        aria-label="Explorar catálogo de piezas"
                    >
                        Explorar Piezas
                    </a>
                </div>
            </div>
            <div>
                <img 
                    src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500&h=400&fit=crop" 
                    alt="Vehículo de lujo premium"
                    class="rounded-2xl shadow-2xl w-full object-cover"
                    loading="lazy"
                >
            </div>
        </div>
    </div>
</section>

<!-- Featured Vehicles Section -->
<section class="py-16 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Vehículos Destacados</h3>
            <p class="text-slate-600 max-w-2xl mx-auto text-lg">
                Selección premium de vehículos disponibles en nuestro inventario
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($featuredVehicles as $vehicle)
                @php
                    $img = $vehicle->images->first();
                    $imgSrc = $img ? (filter_var($img->path, FILTER_VALIDATE_URL) ? $img->path : asset('storage/' . $img->path)) : 'https://via.placeholder.com/800x600?text=Sin+imagen';
                    $brand = $vehicle->variant && $vehicle->variant->model && $vehicle->variant->model->brand ? $vehicle->variant->model->brand->name : null;
                    $model = $vehicle->variant && $vehicle->variant->model ? $vehicle->variant->model->name : null;
                    $variant = $vehicle->variant ? $vehicle->variant->name : null;
                    $title = trim(($brand ? $brand.' ' : '').($model ? $model.' ' : '').($variant ? $variant.' ' : '').($vehicle->year ?? '')) ?: ($vehicle->name ?? 'Vehículo');
                @endphp

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow cursor-pointer">
                    <div class="relative overflow-hidden bg-slate-200 h-56">
                        <img 
                            src="{{ $imgSrc }}" 
                            alt="{{ $title }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                        @if($vehicle->price)
                            <div class="absolute top-3 right-3 bg-yellow-400 text-blue-900 px-3 py-1 rounded-lg font-bold text-sm">
                                ${{{ number_format($vehicle->price ?? 0, 0) }}}
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h4 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">{{ $title }}</h4>
                        <p class="text-slate-600 text-sm mb-4">
                            @if($vehicle->condition)
                                <span class="inline-block">{{ $vehicle->condition }}</span>
                            @endif
                            @if($vehicle->mileage)
                                <span class="inline-block">· {{ number_format($vehicle->mileage) }} km</span>
                            @endif
                        </p>
                        <a 
                            href="{{ route('vehiculos') }}" 
                            class="inline-flex items-center justify-center w-full min-h-10 px-4 py-2 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 cursor-pointer"
                            aria-label="Ver más detalles de {{ $title }}"
                        >
                            Ver detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 bg-white rounded-xl shadow-md p-12 text-center">
                    <p class="text-slate-600 text-lg">No hay vehículos destacados disponibles en este momento.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a 
                href="{{ route('vehiculos') }}" 
                class="inline-flex items-center justify-center min-h-12 px-8 py-3 border-2 border-blue-900 text-blue-900 font-semibold rounded-lg hover:bg-blue-900 hover:text-white cursor-pointer"
            >
                Ver todos los vehículos
            </a>
        </div>
    </div>
</section>

<!-- Parts/Accessories Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Piezas Automotrices</h3>
            <p class="text-slate-600 max-w-2xl mx-auto text-lg">
                Encuentra repuestos originales y alternativos para todas las marcas
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-4 md:gap-6">
            <button 
                class="group min-h-32 bg-blue-900 text-white p-6 rounded-xl hover:bg-blue-800 cursor-pointer transition-all shadow-md hover:shadow-lg"
                aria-label="Ver categoría de motores"
            >
                <div class="text-3xl mb-3">🔧</div>
                <h4 class="font-semibold text-lg group-hover:text-yellow-400">Motores</h4>
            </button>
            
            <button 
                class="group min-h-32 bg-blue-900 text-white p-6 rounded-xl hover:bg-blue-800 cursor-pointer transition-all shadow-md hover:shadow-lg"
                aria-label="Ver categoría de frenos"
            >
                <div class="text-3xl mb-3">🛑</div>
                <h4 class="font-semibold text-lg group-hover:text-yellow-400">Frenos</h4>
            </button>
            
            <button 
                class="group min-h-32 bg-blue-900 text-white p-6 rounded-xl hover:bg-blue-800 cursor-pointer transition-all shadow-md hover:shadow-lg"
                aria-label="Ver categoría de suspensión"
            >
                <div class="text-3xl mb-3">⚙️</div>
                <h4 class="font-semibold text-lg group-hover:text-yellow-400">Suspensión</h4>
            </button>
            
            <button 
                class="group min-h-32 bg-blue-900 text-white p-6 rounded-xl hover:bg-blue-800 cursor-pointer transition-all shadow-md hover:shadow-lg"
                aria-label="Ver categoría de accesorios"
            >
                <div class="text-3xl mb-3">🎁</div>
                <h4 class="font-semibold text-lg group-hover:text-yellow-400">Accesorios</h4>
            </button>
        </div>

        <div class="text-center mt-10">
            <a 
                href="{{ route('piezas') }}" 
                class="inline-flex items-center justify-center min-h-12 px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer"
            >
                Explorar todas las piezas
            </a>
        </div>
    </div>
</section>

<!-- Trust Indicators Section -->
<section class="py-16 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-900 mb-2">500+</div>
                <p class="text-slate-600 font-medium">Vehículos en inventario</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-900 mb-2">10K+</div>
                <p class="text-slate-600 font-medium">Piezas disponibles</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-900 mb-2">5K+</div>
                <p class="text-slate-600 font-medium">Clientes satisfechos</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-blue-900 text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h3 class="text-3xl md:text-4xl font-bold mb-4">¿Listo para comprar o vender?</h3>
        <p class="text-blue-100 mb-8 text-lg max-w-2xl mx-auto">
            Únete a miles de clientes satisfechos y encuentra lo que necesitas
        </p>
        <a 
            href="{{ route('registro') }}" 
            class="inline-flex items-center justify-center min-h-12 px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer"
        >
            Crear cuenta gratis
        </a>
    </div>
</section>
@endsection
