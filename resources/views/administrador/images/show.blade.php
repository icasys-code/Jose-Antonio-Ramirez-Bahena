@extends('administrador.plantilla')

@section('title', 'Ver Image - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detalle de Image</h1>
        <p class="text-sm text-slate-500 mt-1">Consulte la información completa de este registro.</p>
    </div>
    <div class="inline-flex items-center gap-2">
        <a href="{{ route('admin.images.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
        </a>
        <a href="{{ route('admin.images.edit', $image) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all cursor-pointer">
            <i data-lucide="edit" class="w-4 h-4"></i> Editar
        </a>
    </div>
</div>

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden">
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Path</dt>
                <dd class="text-sm font-semibold text-slate-800">
                    @if($image->path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $image->path) }}" class="max-w-xs h-auto object-cover rounded-2xl border border-slate-100 shadow-md">
                        </div>
                    @else
                        <span class="text-slate-400">Sin Imagen</span>
                    @endif
                </dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Disk</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->disk }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Mime type</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->mime_type }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Imageable id</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->imageable_id }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Imageable type</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->imageable_type }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Alt</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->alt }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Order</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $image->order }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Creado</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $image->created_at ? $image->created_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Última Actualización</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $image->updated_at ? $image->updated_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
