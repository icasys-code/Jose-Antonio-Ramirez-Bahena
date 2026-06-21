@extends('administrador.plantilla')

@section('title', 'Image - Panel Admin')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Image</h1>
        <p class="text-sm text-slate-500 mt-1">Administre los registros de Image en el sistema.</p>
    </div>
    <a href="{{ route('admin.images.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer">
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
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold">
                    <th class="px-6 py-4 border-b border-slate-100">Path</th>
                    <th class="px-6 py-4 border-b border-slate-100">Disk</th>
                    <th class="px-6 py-4 border-b border-slate-100">Mime type</th>
                    <th class="px-6 py-4 border-b border-slate-100">Imageable id</th>
                    <th class="px-6 py-4 border-b border-slate-100">Imageable type</th>
                    <th class="px-6 py-4 border-b border-slate-100">Alt</th>
                    <th class="px-6 py-4 border-b border-slate-100">Order</th>
                    <th class="px-6 py-4 border-b border-slate-100 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($images as $item)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 text-sm text-slate-600">
                            @if($item->path)
                                <img src="{{ asset('storage/' . $item->path) }}" class="w-16 h-16 object-cover rounded-xl border border-slate-100 shadow-sm">
                            @else
                                <span class="text-slate-400">Sin Imagen</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->disk }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->mime_type }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->imageable_id }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->imageable_type }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->alt }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('admin.images.show', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-indigo-600 hover:text-indigo-900 font-semibold text-xs bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors cursor-pointer"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Ver</a>
                                <a href="{{ route('admin.images.edit', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-amber-600 hover:text-amber-900 font-semibold text-xs bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors cursor-pointer"><i data-lucide="edit" class="w-3.5 h-3.5"></i> Editar</a>
                                <form method="POST" action="{{ route('admin.images.destroy', $item) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 hover:bg-rose-100 rounded-lg border-0 transition-colors cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="p-3 bg-slate-50 border border-slate-100 text-slate-400 rounded-full"><i data-lucide="inbox" class="w-8 h-8"></i></div>
                                <p class="text-sm font-medium text-slate-500">No se encontraron registros de Image</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($images->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
            {{ $images->links() }}
        </div>
    @endif
</div>
@endsection
