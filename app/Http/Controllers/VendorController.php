<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $vendors = $query->paginate(15);

        return view('administrador.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('administrador.vendors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Vendor::create($validated);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor creado exitosamente');
    }

    public function show(Vendor $vendor)
    {
        return view('administrador.vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('administrador.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $vendor->update($validated);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor actualizado exitosamente');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor eliminado exitosamente');
    }
}
