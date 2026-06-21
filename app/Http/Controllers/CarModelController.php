<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Models\Brand;

class CarModelController extends Controller
{
    public function index(Request $request)
    {
        $query = CarModel::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $carmodels = $query->paginate(15);

        return view('administrador.carmodels.index', compact('carmodels'));
    }

    public function create()
    {
        $brands = Brand::all();

        return view('administrador.carmodels.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            // Add extra validation rules here
        ]);

        CarModel::create($validated);

        return redirect()->route('admin.carmodels.index')->with('success', 'CarModel creado exitosamente');
    }

    public function show(CarModel $carmodel)
    {
        return view('administrador.carmodels.show', compact('carmodel'));
    }

    public function edit(CarModel $carmodel)
    {
        $brands = Brand::all();

        return view('administrador.carmodels.edit', compact('carmodel', 'brands'));
    }

    public function update(Request $request, CarModel $carmodel)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            // Add extra validation rules here
        ]);

        $carmodel->update($validated);

        return redirect()->route('admin.carmodels.index')->with('success', 'CarModel actualizado exitosamente');
    }

    public function destroy(CarModel $carmodel)
    {
        $carmodel->delete();

        return redirect()->route('admin.carmodels.index')->with('success', 'CarModel eliminado exitosamente');
    }
}
