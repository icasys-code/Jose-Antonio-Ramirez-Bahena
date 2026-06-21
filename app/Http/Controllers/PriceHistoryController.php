<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use Illuminate\Http\Request;
use App\Models\User;

class PriceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = PriceHistory::query();

        $pricehistorys = $query->paginate(15);

        return view('administrador.pricehistorys.index', compact('pricehistorys'));
    }

    public function create()
    {
        $users = User::all();

        return view('administrador.pricehistorys.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            // Add extra validation rules here
        ]);

        PriceHistory::create($validated);

        return redirect()->route('admin.pricehistorys.index')->with('success', 'PriceHistory creado exitosamente');
    }

    public function show(PriceHistory $pricehistory)
    {
        return view('administrador.pricehistorys.show', compact('pricehistory'));
    }

    public function edit(PriceHistory $pricehistory)
    {
        $users = User::all();

        return view('administrador.pricehistorys.edit', compact('pricehistory', 'users'));
    }

    public function update(Request $request, PriceHistory $pricehistory)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            // Add extra validation rules here
        ]);

        $pricehistory->update($validated);

        return redirect()->route('admin.pricehistorys.index')->with('success', 'PriceHistory actualizado exitosamente');
    }

    public function destroy(PriceHistory $pricehistory)
    {
        $pricehistory->delete();

        return redirect()->route('admin.pricehistorys.index')->with('success', 'PriceHistory eliminado exitosamente');
    }
}
