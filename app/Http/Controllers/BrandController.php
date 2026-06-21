<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->paginate(15);

        return view('administrador.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('administrador.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Brand::create($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand creado exitosamente');
    }

    public function show(Brand $brand)
    {
        return view('administrador.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('administrador.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand actualizado exitosamente');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand eliminado exitosamente');
    }
}
