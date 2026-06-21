@extends('cliente.plantilla')

@section('title', 'Publicar - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Publicar vehículo o pieza</h2>
            <p class="text-slate-600 text-lg">Agrega tu vehículo o refacción al catálogo en pocos pasos. Completa la información y nuestro equipo revisará tu publicación.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <div class="bg-slate-50 border border-slate-200 rounded-lg p-8 hover:shadow-md transition">
                <div class="text-4xl mb-4">🚗</div>
                <h3 class="font-bold text-xl text-blue-900 mb-3">Publicar Vehículo</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">Publica autos, camionetas y SUV actuales o semi nuevos. Incluye fotos de alta calidad, especificaciones técnicas y precio competitivo.</p>
                <ul class="text-sm text-slate-600 space-y-2 mb-6">
                    <li>✓ Fotos y video del vehículo</li>
                    <li>✓ Datos técnicos completos</li>
                    <li>✓ Historial de servicio</li>
                    <li>✓ Precio y términos de venta</li>
                </ul>
                <a href="{{ route('registro') }}" class="block text-center min-h-11 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 transition cursor-pointer py-2">
                    Publicar vehículo
                </a>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-lg p-8 hover:shadow-md transition">
                <div class="text-4xl mb-4">⚙️</div>
                <h3 class="font-bold text-xl text-blue-900 mb-3">Publicar Pieza</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">Vende piezas originales o compatibles para todas las marcas. Proporciona detalles técnicos precisos y condiciones del producto.</p>
                <ul class="text-sm text-slate-600 space-y-2 mb-6">
                    <li>✓ Descripción detallada</li>
                    <li>✓ Fotografías claras</li>
                    <li>✓ Especificaciones técnicas</li>
                    <li>✓ Garantía y condiciones</li>
                </ul>
                <a href="{{ route('registro') }}" class="block text-center min-h-11 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 transition cursor-pointer py-2">
                    Publicar pieza
                </a>
            </div>
        </div>

        <!-- Process Steps -->
        <div class="bg-blue-900 text-white rounded-lg p-8">
            <h3 class="text-2xl font-bold mb-8 text-center">Proceso de Publicación</h3>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-400 text-blue-900 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-4">1</div>
                    <h4 class="font-semibold mb-2">Registrarse</h4>
                    <p class="text-sm text-blue-100">Crea tu cuenta gratuita</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-400 text-blue-900 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-4">2</div>
                    <h4 class="font-semibold mb-2">Completa Datos</h4>
                    <p class="text-sm text-blue-100">Información del producto</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-400 text-blue-900 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-4">3</div>
                    <h4 class="font-semibold mb-2">Sube Fotos</h4>
                    <p class="text-sm text-blue-100">Imágenes de calidad</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-400 text-blue-900 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-4">4</div>
                    <h4 class="font-semibold mb-2">Publicar</h4>
                    <p class="text-sm text-blue-100">Tu anuncio en línea</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
