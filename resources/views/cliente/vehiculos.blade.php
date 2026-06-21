@extends('cliente.plantilla')

@section('title', 'Vehículos - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Vehículos en Venta</h2>
            <p class="text-slate-600 text-lg max-w-3xl">Explora nuestro inventario de vehículos disponibles. Cada opción cuenta con historia, estado y precios claros. Selecciona los que te interesan para más información.</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="mb-10 bg-slate-50 p-6 rounded-lg">
            <label for="search" class="block text-sm font-medium text-slate-900 mb-2">Buscar vehículo</label>
            <input 
                type="text" 
                id="search" 
                placeholder="Marca, modelo o año..." 
                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
                aria-label="Buscar vehículos"
            >
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @forelse($vehicles as $vehicle)
                @php
                    $img = $vehicle->images->first();
                    if ($img) {
                        $imgSrc = filter_var($img->path, FILTER_VALIDATE_URL) ? $img->path : asset('storage/' . $img->path);
                    } else {
                        $imgSrc = 'https://via.placeholder.com/800x600?text=Sin+imagen';
                    }

                    $brand = $vehicle->variant && $vehicle->variant->model && $vehicle->variant->model->brand ? $vehicle->variant->model->brand->name : null;
                    $model = $vehicle->variant && $vehicle->variant->model ? $vehicle->variant->model->name : null;
                    $variant = $vehicle->variant ? $vehicle->variant->name : null;
                    $title = trim(($brand ? $brand.' ' : '').($model ? $model.' ' : '').($variant ? $variant.' ' : '').($vehicle->year ?? '')) ?: ($vehicle->name ?? 'Vehículo');
                @endphp

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative overflow-hidden bg-slate-200 h-56">
                        <img 
                            src="{{ $imgSrc }}" 
                            alt="{{ $title }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                        @if($vehicle->price)
                            <div class="absolute top-3 right-3 bg-yellow-400 text-blue-900 px-3 py-1 rounded font-bold text-sm">
                                ${{{ number_format($vehicle->price ?? 0, 0) }}}
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2">{{ $title }}</h3>
                        <div class="space-y-2 mb-4">
                            @if($vehicle->condition)
                                <p class="text-slate-600 text-sm">
                                    <span class="font-semibold">Estado:</span> {{ $vehicle->condition }}
                                </p>
                            @endif
                            @if($vehicle->mileage)
                                <p class="text-slate-600 text-sm">
                                    <span class="font-semibold">Kilometraje:</span> {{ number_format($vehicle->mileage) }} km
                                </p>
                            @endif
                            @if($vehicle->year)
                                <p class="text-slate-600 text-sm">
                                    <span class="font-semibold">Año:</span> {{ $vehicle->year }}
                                </p>
                            @endif
                        </div>
                        <button 
                            class="w-full min-h-10 px-4 py-2 bg-blue-900 text-white font-semibold rounded hover:bg-blue-800 transition cursor-pointer"
                            aria-label="Ver más detalles de {{ $title }}"
                        >
                            Ver detalles
                        </button>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-slate-600 text-lg">No hay vehículos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($vehicles->hasPages())
            <div class="flex justify-center">
                {{ $vehicles->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
