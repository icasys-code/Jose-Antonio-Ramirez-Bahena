<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index(Request $request)
    {
        $query = Component::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $components = $query->paginate(15);

        return view('administrador.components.index', compact('components'));
    }

    public function create()
    {
        return view('administrador.components.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        Component::create($validated);

        return redirect()->route('admin.components.index')->with('success', 'Component creado exitosamente');
    }

    public function show(Component $component)
    {
        return view('administrador.components.show', compact('component'));
    }

    public function edit(Component $component)
    {
        return view('administrador.components.edit', compact('component'));
    }

    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'name' => 'required',
            // Add extra validation rules here
        ]);

        $component->update($validated);

        return redirect()->route('admin.components.index')->with('success', 'Component actualizado exitosamente');
    }

    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('admin.components.index')->with('success', 'Component eliminado exitosamente');
    }
}
