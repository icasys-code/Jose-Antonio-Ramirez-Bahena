@extends('cliente.plantilla')

@section('title', 'Registro - AutoPremium')

@section('content')
<section class="bg-white py-16 md:py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-blue-900 text-white rounded-lg shadow-lg p-8 md:p-12">
            <h2 class="text-4xl font-bold mb-4">Crear cuenta</h2>
            <p class="text-blue-100 mb-8 text-lg">Regístrate para comenzar a publicar vehículos y piezas. Accede a todas nuestras características de forma rápida y segura.</p>
            
            <form class="space-y-6">
                <div>
                    <label for="fullname" class="block text-sm font-semibold mb-2">Nombre completo</label>
                    <input 
                        type="text" 
                        id="fullname" 
                        placeholder="Tu nombre completo" 
                        class="w-full px-4 py-3 rounded-lg border border-blue-200 text-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold mb-2">Correo electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        placeholder="tu@email.com" 
                        class="w-full px-4 py-3 rounded-lg border border-blue-200 text-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required
                    >
                    <p class="text-sm text-blue-100 mt-1">Usa una dirección válida para recibir confirmaciones.</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold mb-2">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        placeholder="Crea una contraseña segura" 
                        class="w-full px-4 py-3 rounded-lg border border-blue-200 text-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required
                    >
                </div>

                <div>
                    <label for="password_confirm" class="block text-sm font-semibold mb-2">Confirmar contraseña</label>
                    <input 
                        type="password" 
                        id="password_confirm" 
                        placeholder="Confirma tu contraseña" 
                        class="w-full px-4 py-3 rounded-lg border border-blue-200 text-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required
                    >
                </div>

                <div class="flex items-start">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        class="mt-1"
                        required
                    >
                    <label for="terms" class="ml-2 text-sm">Acepto los términos y condiciones</label>
                </div>

                <button 
                    type="submit" 
                    class="w-full min-h-12 bg-yellow-400 text-blue-900 font-bold rounded-lg hover:bg-yellow-300 transition cursor-pointer"
                >
                    Crear cuenta gratis
                </button>
            </form>

            <p class="text-center text-blue-100 mt-6 text-sm">
                ¿Ya tienes cuenta? <a href="{{ route('home') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold cursor-pointer">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</section>
@endsection
