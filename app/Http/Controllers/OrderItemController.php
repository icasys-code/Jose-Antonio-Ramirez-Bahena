<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderItem::query();

        $orderitems = $query->paginate(15);

        return view('administrador.orderitems.index', compact('orderitems'));
    }

    public function create()
    {
        $orders = Order::all();

        return view('administrador.orderitems.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required',
            // Add extra validation rules here
        ]);

        OrderItem::create($validated);

        return redirect()->route('admin.orderitems.index')->with('success', 'OrderItem creado exitosamente');
    }

    public function show(OrderItem $orderitem)
    {
        return view('administrador.orderitems.show', compact('orderitem'));
    }

    public function edit(OrderItem $orderitem)
    {
        $orders = Order::all();

        return view('administrador.orderitems.edit', compact('orderitem', 'orders'));
    }

    public function update(Request $request, OrderItem $orderitem)
    {
        $validated = $request->validate([
            'order_id' => 'required',
            // Add extra validation rules here
        ]);

        $orderitem->update($validated);

        return redirect()->route('admin.orderitems.index')->with('success', 'OrderItem actualizado exitosamente');
    }

    public function destroy(OrderItem $orderitem)
    {
        $orderitem->delete();

        return redirect()->route('admin.orderitems.index')->with('success', 'OrderItem eliminado exitosamente');
    }
}
