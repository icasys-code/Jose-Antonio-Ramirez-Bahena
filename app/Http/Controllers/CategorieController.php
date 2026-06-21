<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(Request $request)
    {
        $query = Categorie::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(15);

        return view('administrador.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Categorie::all();

        return view('administrador.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
            // Add extra validation rules here
        ]);

        Categorie::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categorie creado exitosamente');
    }

    public function show(Categorie $categorie)
    {
        return view('administrador.categories.show', compact('categorie'));
    }

    public function edit(Categorie $categorie)
    {
        $categories = Categorie::all();

        return view('administrador.categories.edit', compact('categorie', 'categories'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
            // Add extra validation rules here
        ]);

        $categorie->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categorie actualizado exitosamente');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categorie eliminado exitosamente');
    }
}
