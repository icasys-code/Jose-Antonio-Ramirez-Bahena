<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $query = Attribute::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $attributes = $query->paginate(15);

        return view('administrador.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('administrador.attributes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Attribute::create($validated);

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute creado exitosamente');
    }

    public function show(Attribute $attribute)
    {
        return view('administrador.attributes.show', compact('attribute'));
    }

    public function edit(Attribute $attribute)
    {
        return view('administrador.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $attribute->update($validated);

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute actualizado exitosamente');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute eliminado exitosamente');
    }
}
