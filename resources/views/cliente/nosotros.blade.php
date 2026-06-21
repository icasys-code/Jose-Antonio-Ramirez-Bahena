@extends('cliente.plantilla')

@section('title', 'Nosotros - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Sobre AutoPremium</h2>
            <p class="text-slate-600 text-lg">Somos una refaccionaria automotriz dedicada a ofrecer vehículos y repuestos con atención especializada. Este proyecto forma parte del trabajo final de ICASYS y está diseñado para ser intuitivo, funcional y moderno.</p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <div class="bg-slate-50 rounded-lg border border-slate-200 shadow-md p-8">
                <div class="text-4xl mb-4">🎯</div>
                <h3 class="text-2xl font-bold text-blue-900 mb-4">Misión</h3>
                <p class="text-slate-600 leading-relaxed">Brindar una plataforma confiable y accesible para la compra y venta de vehículos y piezas automotrices de calidad, facilitando conexiones entre compradores y vendedores con transparencia y seguridad.</p>
            </div>
            <div class="bg-slate-50 rounded-lg border border-slate-200 shadow-md p-8">
                <div class="text-4xl mb-4">🌟</div>
                <h3 class="text-2xl font-bold text-blue-900 mb-4">Visión</h3>
                <p class="text-slate-600 leading-relaxed">Ser la refaccionaria preferida por su variedad, transparencia y calidad de servicio. Aspira a ser el destino de confianza para quienes buscan vehículos y repuestos automotrices confiables.</p>
            </div>
        </div>

        <!-- Values -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-blue-900 mb-8 text-center">Nuestros Valores</h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white border border-slate-200 rounded-lg p-6">
                    <div class="text-3xl mb-3">✓</div>
                    <h4 class="font-bold text-blue-900 mb-2">Confianza</h4>
                    <p class="text-slate-600">Operamos con transparencia total en precios, condiciones y documentación de todos nuestros productos.</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-lg p-6">
                    <div class="text-3xl mb-3">⭐</div>
                    <h4 class="font-bold text-blue-900 mb-2">Calidad</h4>
                    <p class="text-slate-600">Cada vehículo y pieza es verificado para garantizar los más altos estándares de calidad.</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-lg p-6">
                    <div class="text-3xl mb-3">🚀</div>
                    <h4 class="font-bold text-blue-900 mb-2">Innovación</h4>
                    <p class="text-slate-600">Utilizamos tecnología moderna para facilitar y mejorar la experiencia de compra y venta.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center bg-blue-900 text-white rounded-lg p-8">
            <h3 class="text-2xl font-bold mb-4">¿Quieres ser parte de nosotros?</h3>
            <p class="text-blue-100 mb-6">Únete a nuestra comunidad de vendedores y compradores confiables.</p>
            <a href="{{ route('registro') }}" class="inline-flex items-center justify-center min-h-12 px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 cursor-pointer transition">
                Crear cuenta hoy
            </a>
        </div>
    </div>
</section>
@endsection
