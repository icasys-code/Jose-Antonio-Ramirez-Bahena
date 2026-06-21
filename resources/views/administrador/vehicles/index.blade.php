@extends('administrador.plantilla')

@section('title', 'Vehicle - Panel Admin')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Vehicle</h1>
        <p class="text-sm text-slate-500 mt-1">Administre los registros de Vehicle en el sistema.</p>
    </div>
    <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer">
        <i data-lucide="plus" class="w-4 h-4"></i> Crear Nuevo
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-emerald-800 text-sm font-medium shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden">
    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
        <form method="GET" class="flex gap-3 max-w-md">
            <div class="relative flex-1">
                <input type="text" name="search" class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400 shadow-sm" placeholder="Buscar por vin..." value="{{ request('search') }}">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-slate-400"></i>
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded-xl text-sm font-semibold hover:bg-slate-900 transition-colors shadow-sm cursor-pointer">Buscar</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold">
                    <th class="px-6 py-4 border-b border-slate-100">Car variant id</th>
                    <th class="px-6 py-4 border-b border-slate-100">Vin</th>
                    <th class="px-6 py-4 border-b border-slate-100">Stock code</th>
                    <th class="px-6 py-4 border-b border-slate-100">Year</th>
                    <th class="px-6 py-4 border-b border-slate-100">Color</th>
                    <th class="px-6 py-4 border-b border-slate-100">Mileage</th>
                    <th class="px-6 py-4 border-b border-slate-100">Price</th>
                    <th class="px-6 py-4 border-b border-slate-100">Condition</th>
                    <th class="px-6 py-4 border-b border-slate-100">Description</th>
                    <th class="px-6 py-4 border-b border-slate-100 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($vehicles as $item)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->variant ? $item->variant->name : 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->vin }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->stock_code }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->year }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->color }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->mileage }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                            ${{ number_format($item->price, 2) }} {{ $item->currency ?? 'MXN' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->condition }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->description }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('admin.vehicles.show', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-indigo-600 hover:text-indigo-900 font-semibold text-xs bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors cursor-pointer"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Ver</a>
                                <a href="{{ route('admin.vehicles.edit', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-amber-600 hover:text-amber-900 font-semibold text-xs bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors cursor-pointer"><i data-lucide="edit" class="w-3.5 h-3.5"></i> Editar</a>
                                <form method="POST" action="{{ route('admin.vehicles.destroy', $item) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 hover:bg-rose-100 rounded-lg border-0 transition-colors cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="p-3 bg-slate-50 border border-slate-100 text-slate-400 rounded-full"><i data-lucide="inbox" class="w-8 h-8"></i></div>
                                <p class="text-sm font-medium text-slate-500">No se encontraron registros de Vehicle</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($vehicles->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $vehicles->links() }}
        </div>
    @endif
</div>
@endsection
