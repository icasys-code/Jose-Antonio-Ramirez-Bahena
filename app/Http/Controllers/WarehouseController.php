<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $query = Warehouse::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $warehouses = $query->paginate(15);

        return view('administrador.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('administrador.warehouses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Warehouse::create($validated);

        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse creado exitosamente');
    }

    public function show(Warehouse $warehouse)
    {
        return view('administrador.warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse)
    {
        return view('administrador.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $warehouse->update($validated);

        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse actualizado exitosamente');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse eliminado exitosamente');
    }
}
