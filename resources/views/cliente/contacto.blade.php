@extends('cliente.plantilla')

@section('title', 'Contacto - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Contacto</h2>
            <p class="text-slate-600 text-lg">Si tienes dudas sobre nuestras piezas, vehículos o servicios, escríbenos y te responderemos lo antes posible.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Contact Information -->
            <div class="space-y-6">
                <div class="bg-slate-50 rounded-lg border border-slate-200 p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Información de Contacto</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Email</p>
                            <a href="mailto:info@autopremium.com" class="text-blue-900 hover:text-blue-800 font-medium cursor-pointer">info@autopremium.com</a>
                        </div>
                        
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Teléfono</p>
                            <a href="tel:+525512345678" class="text-blue-900 hover:text-blue-800 font-medium cursor-pointer">+52 55 1234 5678</a>
                        </div>
                        
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Ubicación</p>
                            <p class="text-slate-600 mt-1">Ciudad de México, México</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Horario de Atención</p>
                            <p class="text-slate-600 mt-1">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                            <p class="text-slate-600">Sábado: 10:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-slate-50 rounded-lg border border-slate-200 p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-6">Envíanos un mensaje</h3>
                <form class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-900 mb-1">Nombre</label>
                        <input 
                            type="text" 
                            id="name" 
                            placeholder="Tu nombre completo" 
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
                            required
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-900 mb-1">Correo electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            placeholder="tu@email.com" 
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
                            required
                        >
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-900 mb-1">Mensaje</label>
                        <textarea 
                            id="message" 
                            placeholder="Tu mensaje aquí..." 
                            rows="5"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
                            required
                        ></textarea>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full min-h-11 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 transition cursor-pointer"
                    >
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
