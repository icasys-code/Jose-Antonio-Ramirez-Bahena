<?php

namespace App\Http\Controllers;

use App\Models\PartVariant;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\CarVariant;

class PartVariantController extends Controller
{
    public function index(Request $request)
    {
        $query = PartVariant::query();

        $partvariants = $query->paginate(15);

        return view('administrador.partvariants.index', compact('partvariants'));
    }

    public function create()
    {
        $parts = Part::all();
        $carvariants = CarVariant::all();

        return view('administrador.partvariants.create', compact('parts', 'carvariants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_id' => 'required',
            'car_variant_id' => 'required',
            // Add extra validation rules here
        ]);

        PartVariant::create($validated);

        return redirect()->route('admin.partvariants.index')->with('success', 'PartVariant creado exitosamente');
    }

    public function show(PartVariant $partvariant)
    {
        return view('administrador.partvariants.show', compact('partvariant'));
    }

    public function edit(PartVariant $partvariant)
    {
        $parts = Part::all();
        $carvariants = CarVariant::all();

        return view('administrador.partvariants.edit', compact('partvariant', 'parts', 'carvariants'));
    }

    public function update(Request $request, PartVariant $partvariant)
    {
        $validated = $request->validate([
            'part_id' => 'required',
            'car_variant_id' => 'required',
            // Add extra validation rules here
        ]);

        $partvariant->update($validated);

        return redirect()->route('admin.partvariants.index')->with('success', 'PartVariant actualizado exitosamente');
    }

    public function destroy(PartVariant $partvariant)
    {
        $partvariant->delete();

        return redirect()->route('admin.partvariants.index')->with('success', 'PartVariant eliminado exitosamente');
    }
}
