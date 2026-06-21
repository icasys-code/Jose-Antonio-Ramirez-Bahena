@extends('administrador.plantilla')

@section('title', 'Editar Part - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Editar Part</h1>
        <p class="text-sm text-slate-500 mt-1">Modifique los campos correspondientes del registro.</p>
    </div>
    <a href="{{ route('admin.parts.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
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
    <form method="POST" action="{{ route('admin.parts.update', $part) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="sku" class="block text-sm font-semibold text-slate-700 mb-2">Sku</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku', $part->sku) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" required >
            </div>
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $part->name) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" required >
            </div>
            <div>
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Category id</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all" required>
                    <option value="">Seleccionar...</option>
                    @foreach($categories as $rel)
                        <option value="{{ $rel->id }}" {{ old('category_id', $part->category_id) == $rel->id ? 'selected' : '' }}>{{ $rel->name ?? $rel->id }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="manufacturer_id" class="block text-sm font-semibold text-slate-700 mb-2">Manufacturer id</label>
                <select name="manufacturer_id" id="manufacturer_id" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all" required>
                    <option value="">Seleccionar...</option>
                    @foreach($manufacturers as $rel)
                        <option value="{{ $rel->id }}" {{ old('manufacturer_id', $part->manufacturer_id) == $rel->id ? 'selected' : '' }}>{{ $rel->name ?? $rel->id }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400">{{ old('description', $part->description) }}</textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $part->price) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any">
            </div>
            <div>
                <label for="currency" class="block text-sm font-semibold text-slate-700 mb-2">Currency</label>
                <input type="text" name="currency" id="currency" value="{{ old('currency', $part->currency) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="weight" class="block text-sm font-semibold text-slate-700 mb-2">Weight</label>
                <input type="text" name="weight" id="weight" value="{{ old('weight', $part->weight) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Dimensiones (Largo x Ancho x Alto - cm)</label>
                <div class="grid grid-cols-3 gap-3">
                    <input type="number" step="any" name="dimensions[length]" value="{{ old('dimensions.length', $part->dimensions['length'] ?? '') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" placeholder="Largo">
                    <input type="number" step="any" name="dimensions[width]" value="{{ old('dimensions.width', $part->dimensions['width'] ?? '') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" placeholder="Ancho">
                    <input type="number" step="any" name="dimensions[height]" value="{{ old('dimensions.height', $part->dimensions['height'] ?? '') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" placeholder="Alto">
                </div>
            </div>
            <div>
                <label for="stock" class="block text-sm font-semibold text-slate-700 mb-2">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $part->stock) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any">
            </div>
            <div class="flex items-center mt-8">
                <label class="relative flex items-center cursor-pointer">
                    <input type="checkbox" name="active" id="active" value="1" class="sr-only peer" {{ old('active', $part->active) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-500/10 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    <span class="ml-3 text-sm font-semibold text-slate-700">Active</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.parts.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer"><i data-lucide="save" class="w-4 h-4 inline-block mr-1.5 -mt-0.5"></i> Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
