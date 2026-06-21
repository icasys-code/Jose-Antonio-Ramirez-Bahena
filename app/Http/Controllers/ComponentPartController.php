<?php

namespace App\Http\Controllers;

use App\Models\ComponentPart;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Component;

class ComponentPartController extends Controller
{
    public function index(Request $request)
    {
        $query = ComponentPart::query();

        $componentparts = $query->paginate(15);

        return view('administrador.componentparts.index', compact('componentparts'));
    }

    public function create()
    {
        $parts = Part::all();
        $components = Component::all();

        return view('administrador.componentparts.create', compact('parts', 'components'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_id' => 'required',
            'component_id' => 'required',
            // Add extra validation rules here
        ]);

        ComponentPart::create($validated);

        return redirect()->route('admin.componentparts.index')->with('success', 'ComponentPart creado exitosamente');
    }

    public function show(ComponentPart $componentpart)
    {
        return view('administrador.componentparts.show', compact('componentpart'));
    }

    public function edit(ComponentPart $componentpart)
    {
        $parts = Part::all();
        $components = Component::all();

        return view('administrador.componentparts.edit', compact('componentpart', 'parts', 'components'));
    }

    public function update(Request $request, ComponentPart $componentpart)
    {
        $validated = $request->validate([
            'part_id' => 'required',
            'component_id' => 'required',
            // Add extra validation rules here
        ]);

        $componentpart->update($validated);

        return redirect()->route('admin.componentparts.index')->with('success', 'ComponentPart actualizado exitosamente');
    }

    public function destroy(ComponentPart $componentpart)
    {
        $componentpart->delete();

        return redirect()->route('admin.componentparts.index')->with('success', 'ComponentPart eliminado exitosamente');
    }
}
