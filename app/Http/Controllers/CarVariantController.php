<?php

namespace App\Http\Controllers;

use App\Models\CarVariant;
use Illuminate\Http\Request;
use App\Models\CarModel;

class CarVariantController extends Controller
{
    public function index(Request $request)
    {
        $query = CarVariant::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $carvariants = $query->paginate(15);

        return view('administrador.carvariants.index', compact('carvariants'));
    }

    public function create()
    {
        $carmodels = CarModel::all();

        return view('administrador.carvariants.create', compact('carmodels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'car_model_id' => 'required',
            // Add extra validation rules here
        ]);

        CarVariant::create($validated);

        return redirect()->route('admin.carvariants.index')->with('success', 'CarVariant creado exitosamente');
    }

    public function show(CarVariant $carvariant)
    {
        return view('administrador.carvariants.show', compact('carvariant'));
    }

    public function edit(CarVariant $carvariant)
    {
        $carmodels = CarModel::all();

        return view('administrador.carvariants.edit', compact('carvariant', 'carmodels'));
    }

    public function update(Request $request, CarVariant $carvariant)
    {
        $validated = $request->validate([
            'name' => 'required',
            'car_model_id' => 'required',
            // Add extra validation rules here
        ]);

        $carvariant->update($validated);

        return redirect()->route('admin.carvariants.index')->with('success', 'CarVariant actualizado exitosamente');
    }

    public function destroy(CarVariant $carvariant)
    {
        $carvariant->delete();

        return redirect()->route('admin.carvariants.index')->with('success', 'CarVariant eliminado exitosamente');
    }
}
