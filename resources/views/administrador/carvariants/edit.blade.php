@extends('administrador.plantilla')

@section('title', 'Editar CarVariant - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Editar CarVariant</h1>
        <p class="text-sm text-slate-500 mt-1">Modifique los campos correspondientes del registro.</p>
    </div>
    <a href="{{ route('admin.carvariants.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
    </a>
</div>

@if($errors->any())
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm font-medium shadow-sm">
        <div class="flex items-center gap-2 font-bold mb-2">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i> Por favor corrige los siguientes errores:
        </div>
        <ul class="list-disc list-inside space-y-1 ml-2 font-normal">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl p-6 md:p-8">
    <form method="POST" action="{{ route('admin.carvariants.update', $carvariant) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="car_model_id" class="block text-sm font-semibold text-slate-700 mb-2">Car model id</label>
                <select name="car_model_id" id="car_model_id" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all" required>
                    <option value="">Seleccionar...</option>
                    @foreach($carmodels as $rel)
                        <option value="{{ $rel->id }}" {{ old('car_model_id', $carvariant->car_model_id) == $rel->id ? 'selected' : '' }}>{{ $rel->name ?? $rel->id }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $carvariant->name) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" required >
            </div>
            <div>
                <label for="trim" class="block text-sm font-semibold text-slate-700 mb-2">Trim</label>
                <input type="text" name="trim" id="trim" value="{{ old('trim', $carvariant->trim) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="engine" class="block text-sm font-semibold text-slate-700 mb-2">Engine</label>
                <input type="text" name="engine" id="engine" value="{{ old('engine', $carvariant->engine) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="transmission" class="block text-sm font-semibold text-slate-700 mb-2">Transmission</label>
                <input type="text" name="transmission" id="transmission" value="{{ old('transmission', $carvariant->transmission) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="fuel_type" class="block text-sm font-semibold text-slate-700 mb-2">Fuel type</label>
                <input type="text" name="fuel_type" id="fuel_type" value="{{ old('fuel_type', $carvariant->fuel_type) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="doors" class="block text-sm font-semibold text-slate-700 mb-2">Doors</label>
                <input type="text" name="doors" id="doors" value="{{ old('doors', $carvariant->doors) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="notes" class="block text-sm font-semibold text-slate-700 mb-2">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400">{{ old('notes', $carvariant->notes) }}</textarea>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.carvariants.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer"><i data-lucide="save" class="w-4 h-4 inline-block mr-1.5 -mt-0.5"></i> Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
