@extends('administrador.plantilla')

@section('title', 'Editar OrderItem - Panel Admin')

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Editar OrderItem</h1>
        <p class="text-sm text-slate-500 mt-1">Modifique los campos correspondientes del registro.</p>
    </div>
    <a href="{{ route('admin.orderitems.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">
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
    <form method="POST" action="{{ route('admin.orderitems.update', $orderitem) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="order_id" class="block text-sm font-semibold text-slate-700 mb-2">Order id</label>
                <select name="order_id" id="order_id" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all" required>
                    <option value="">Seleccionar...</option>
                    @foreach($orders as $rel)
                        <option value="{{ $rel->id }}" {{ old('order_id', $orderitem->order_id) == $rel->id ? 'selected' : '' }}>{{ $rel->order_number ?? $rel->id }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="item_id" class="block text-sm font-semibold text-slate-700 mb-2">Item id</label>
                <input type="text" name="item_id" id="item_id" value="{{ old('item_id', $orderitem->item_id) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="item_type" class="block text-sm font-semibold text-slate-700 mb-2">Item type</label>
                <input type="text" name="item_type" id="item_type" value="{{ old('item_type', $orderitem->item_type) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  >
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400">{{ old('description', $orderitem->description) }}</textarea>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-semibold text-slate-700 mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $orderitem->quantity) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any">
            </div>
            <div>
                <label for="unit_price" class="block text-sm font-semibold text-slate-700 mb-2">Unit price</label>
                <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', $orderitem->unit_price) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any">
            </div>
            <div>
                <label for="total" class="block text-sm font-semibold text-slate-700 mb-2">Total</label>
                <input type="number" name="total" id="total" value="{{ old('total', $orderitem->total) }}" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400"  step="any">
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.orderitems.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer"><i data-lucide="save" class="w-4 h-4 inline-block mr-1.5 -mt-0.5"></i> Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
