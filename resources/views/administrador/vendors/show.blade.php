@extends('administrador.plantilla')

@section('title', 'Ver Vendor - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detalle de Vendor</h1>
        <p class="text-sm text-slate-500 mt-1">Consulte la información completa de este registro.</p>
    </div>
    <div class="inline-flex items-center gap-2">
        <a href="{{ route('admin.vendors.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
        </a>
        <a href="{{ route('admin.vendors.edit', $vendor) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all cursor-pointer">
            <i data-lucide="edit" class="w-4 h-4"></i> Editar
        </a>
    </div>
</div>

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden">
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Name</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->name }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Contact name</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->contact_name }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Email</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->email }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Phone</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->phone }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Address</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->address }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Notes</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $vendor->notes }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Creado</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $vendor->created_at ? $vendor->created_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Última Actualización</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $vendor->updated_at ? $vendor->updated_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
