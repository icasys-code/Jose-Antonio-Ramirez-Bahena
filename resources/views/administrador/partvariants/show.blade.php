@extends('administrador.plantilla')

@section('title', 'Ver PartVariant - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detalle de PartVariant</h1>
        <p class="text-sm text-slate-500 mt-1">Consulte la información completa de este registro.</p>
    </div>
    <div class="inline-flex items-center gap-2">
        <a href="{{ route('admin.partvariants.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
        </a>
        <a href="{{ route('admin.partvariants.edit', $partvariant) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all cursor-pointer">
            <i data-lucide="edit" class="w-4 h-4"></i> Editar
        </a>
    </div>
</div>

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden">
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Part id</dt>
                <dd class="text-sm font-semibold text-slate-800">{{ $partvariant->part ? $partvariant->part->sku : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Car variant id</dt>
                <dd class="text-sm font-semibold text-slate-800">{{ $partvariant->carVariant ? $partvariant->carVariant->name : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Fitment notes</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $partvariant->fitment_notes }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Direct fit</dt>
                <dd class="text-sm font-semibold text-slate-800">
                    @if($partvariant->direct_fit)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Activo
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-50 text-slate-500 border border-slate-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactivo
                        </span>
                    @endif
                </dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Creado</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $partvariant->created_at ? $partvariant->created_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Última Actualización</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $partvariant->updated_at ? $partvariant->updated_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
