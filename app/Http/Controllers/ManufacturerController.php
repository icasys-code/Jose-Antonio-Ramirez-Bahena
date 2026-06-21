<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $query = Manufacturer::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $manufacturers = $query->paginate(15);

        return view('administrador.manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('administrador.manufacturers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Manufacturer::create($validated);

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer creado exitosamente');
    }

    public function show(Manufacturer $manufacturer)
    {
        return view('administrador.manufacturers.show', compact('manufacturer'));
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('administrador.manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $manufacturer->update($validated);

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer actualizado exitosamente');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer eliminado exitosamente');
    }
}
