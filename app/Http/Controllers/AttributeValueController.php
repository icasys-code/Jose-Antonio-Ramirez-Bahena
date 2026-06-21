<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeValueController extends Controller
{
    public function index(Request $request)
    {
        $query = AttributeValue::query();

        $attributevalues = $query->paginate(15);

        return view('administrador.attributevalues.index', compact('attributevalues'));
    }

    public function create()
    {
        $attributes = Attribute::all();

        return view('administrador.attributevalues.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attribute_id' => 'required',
            // Add extra validation rules here
        ]);

        AttributeValue::create($validated);

        return redirect()->route('admin.attributevalues.index')->with('success', 'AttributeValue creado exitosamente');
    }

    public function show(AttributeValue $attributevalue)
    {
        return view('administrador.attributevalues.show', compact('attributevalue'));
    }

    public function edit(AttributeValue $attributevalue)
    {
        $attributes = Attribute::all();

        return view('administrador.attributevalues.edit', compact('attributevalue', 'attributes'));
    }

    public function update(Request $request, AttributeValue $attributevalue)
    {
        $validated = $request->validate([
            'attribute_id' => 'required',
            // Add extra validation rules here
        ]);

        $attributevalue->update($validated);

        return redirect()->route('admin.attributevalues.index')->with('success', 'AttributeValue actualizado exitosamente');
    }

    public function destroy(AttributeValue $attributevalue)
    {
        $attributevalue->delete();

        return redirect()->route('admin.attributevalues.index')->with('success', 'AttributeValue eliminado exitosamente');
    }
}
