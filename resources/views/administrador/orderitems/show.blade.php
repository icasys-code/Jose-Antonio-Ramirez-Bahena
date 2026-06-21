@extends('administrador.plantilla')

@section('title', 'Ver OrderItem - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detalle de OrderItem</h1>
        <p class="text-sm text-slate-500 mt-1">Consulte la información completa de este registro.</p>
    </div>
    <div class="inline-flex items-center gap-2">
        <a href="{{ route('admin.orderitems.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
        </a>
        <a href="{{ route('admin.orderitems.edit', $orderitem) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all cursor-pointer">
            <i data-lucide="edit" class="w-4 h-4"></i> Editar
        </a>
    </div>
</div>

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden">
    <div class="p-6 md:p-8">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Order id</dt>
                <dd class="text-sm font-semibold text-slate-800">{{ $orderitem->order ? $orderitem->order->order_number : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Item id</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $orderitem->item_id }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Item type</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $orderitem->item_type }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Description</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $orderitem->description }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Quantity</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $orderitem->quantity }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Unit price</dt>
                <dd class="text-sm font-bold text-indigo-600">
                    ${{ number_format($orderitem->unit_price, 2) }} {{ $orderitem->currency ?? 'MXN' }}
                </dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total</dt>
                <dd class="text-sm font-bold text-indigo-600">
                    ${{ number_format($orderitem->total, 2) }} {{ $orderitem->currency ?? 'MXN' }}
                </dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Creado</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $orderitem->created_at ? $orderitem->created_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
            <div class="border-b border-slate-50 pb-4">
                <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Última Actualización</dt>
                <dd class="text-sm font-medium text-slate-600">{{ $orderitem->updated_at ? $orderitem->updated_at->format('d/m/Y H:i') : 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
