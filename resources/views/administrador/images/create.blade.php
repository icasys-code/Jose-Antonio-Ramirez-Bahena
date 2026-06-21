@extends('administrador.plantilla')

@section('title', 'Crear Image - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Crear Image</h1>
        <p class="text-sm text-slate-500 mt-1">Añada un nuevo registro a la base de datos.</p>
    </div>
    <a href="{{ route('admin.images.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
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
    <form method="POST" action="{{ route('admin.images.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Imagen (Archivo)</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
            </div>
            <div>
                <label for="imageable_id" class="block text-sm font-semibold text-slate-700 mb-2">Imageable id</label>
                <input type="text" name="imageable_id" id="imageable_id" value="{{ old('imageable_id') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Imageable id...">
            </div>
            <div>
                <label for="imageable_type" class="block text-sm font-semibold text-slate-700 mb-2">Imageable type</label>
                <input type="text" name="imageable_type" id="imageable_type" value="{{ old('imageable_type') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Imageable type...">
            </div>
            <div>
                <label for="alt" class="block text-sm font-semibold text-slate-700 mb-2">Alt</label>
                <input type="text" name="alt" id="alt" value="{{ old('alt') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Alt...">
            </div>
            <div>
                <label for="order" class="block text-sm font-semibold text-slate-700 mb-2">Order</label>
                <input type="text" name="order" id="order" value="{{ old('order') }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"   placeholder="Ingrese Order...">
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.images.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer"><i data-lucide="save" class="w-4 h-4 inline-block mr-1.5 -mt-0.5"></i> Crear</button>
        </div>
    </form>
</div>
@endsection
