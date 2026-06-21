<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(15);

        return view('administrador.users.index', compact('users'));
    }

    public function create()
    {
        return view('administrador.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            // Add extra validation rules here
        ]);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User creado exitosamente');
    }

    public function show(User $user)
    {
        return view('administrador.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('administrador.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => 'required',
            // Add extra validation rules here
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User actualizado exitosamente');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User eliminado exitosamente');
    }
}
