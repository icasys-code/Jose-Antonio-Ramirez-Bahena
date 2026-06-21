<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Part;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::query();

        $stocks = $query->paginate(15);

        return view('administrador.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        $parts = Part::all();

        return view('administrador.stocks.create', compact('warehouses', 'parts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_id' => 'required',
            'part_id' => 'required',
            // Add extra validation rules here
        ]);

        Stock::create($validated);

        return redirect()->route('admin.stocks.index')->with('success', 'Stock creado exitosamente');
    }

    public function show(Stock $stock)
    {
        return view('administrador.stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        $warehouses = Warehouse::all();
        $parts = Part::all();

        return view('administrador.stocks.edit', compact('stock', 'warehouses', 'parts'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'warehouse_id' => 'required',
            'part_id' => 'required',
            // Add extra validation rules here
        ]);

        $stock->update($validated);

        return redirect()->route('admin.stocks.index')->with('success', 'Stock actualizado exitosamente');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('admin.stocks.index')->with('success', 'Stock eliminado exitosamente');
    }
}
