<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\CarVariant;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('search') && $request->search) {
            $query->where('vin', 'like', '%' . $request->search . '%');
        }

        $vehicles = $query->paginate(15);

        return view('administrador.vehicles.index', compact('vehicles'));
    }

    public function catalog(Request $request)
    {
        $query = Vehicle::query()->with(['variant.model.brand', 'images']);

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $vehicles = $query->paginate(9);

        return view('cliente.vehiculos', compact('vehicles'));
    }

    public function create()
    {
        $carvariants = CarVariant::all();

        return view('administrador.vehicles.create', compact('carvariants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vin' => 'required',
            'car_variant_id' => 'required',
            // Add extra validation rules here
        ]);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle creado exitosamente');
    }

    public function show(Vehicle $vehicle)
    {
        return view('administrador.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $carvariants = CarVariant::all();

        return view('administrador.vehicles.edit', compact('vehicle', 'carvariants'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'vin' => 'required',
            'car_variant_id' => 'required',
            // Add extra validation rules here
        ]);

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle actualizado exitosamente');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle eliminado exitosamente');
    }
}
