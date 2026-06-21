@extends('administrador.plantilla')

@section('title', 'Crear Vehicle - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Crear Vehicle</h1>
        <p class="text-sm text-slate-500 mt-1">Añada un nuevo registro a la base de datos.</p>
    </div>
    <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
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
    <form method="POST" action="{{ route('admin.vehicles.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="car_variant_id" class="block text-sm font-semibold text-slate-700 mb-2">Car variant id</label>
                <select name="car_variant_id" id="car_variant_id" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all" required>
                    <option value="">Seleccionar...</option>
                    @foreach($carvariants as $rel)
                        <option value="{{ $rel->id }}" {{ old('car_variant_id') == $rel->id ? 'selected' : '' }}>{{ $rel->name ?? $rel->id }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="vin" class="block text-sm font-semibold text-slate-700 mb-2">Vin</label>
                <input type="text" name="vin" id="vin" value="{{ old('vin') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" required  placeholder="Ingrese Vin...">
            </div>
            <div>
                <label for="stock_code" class="block text-sm font-semibold text-slate-700 mb-2">Stock code</label>
                <input type="text" name="stock_code" id="stock_code" value="{{ old('stock_code') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Stock code...">
            </div>
            <div>
                <label for="year" class="block text-sm font-semibold text-slate-700 mb-2">Year</label>
                <input type="text" name="year" id="year" value="{{ old('year') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Year...">
            </div>
            <div>
                <label for="color" class="block text-sm font-semibold text-slate-700 mb-2">Color</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Color...">
            </div>
            <div>
                <label for="mileage" class="block text-sm font-semibold text-slate-700 mb-2">Mileage</label>
                <input type="text" name="mileage" id="mileage" value="{{ old('mileage') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Mileage...">
            </div>
            <div>
                <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any" placeholder="Ingrese Price...">
            </div>
            <div>
                <label for="condition" class="block text-sm font-semibold text-slate-700 mb-2">Condition</label>
                <input type="text" name="condition" id="condition" value="{{ old('condition') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Condition...">
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" placeholder="Ingrese Description...">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.vehicles.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer"><i data-lucide="save" class="w-4 h-4 inline-block mr-1.5 -mt-0.5"></i> Crear</button>
        </div>
    </form>
</div>
@endsection
