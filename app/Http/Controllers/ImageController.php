<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $query = Image::query();

        $images = $query->paginate(15);

        return view('administrador.images.index', compact('images'));
    }

    public function create()
    {
        return view('administrador.images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096',
            'imageable_id' => 'required|integer',
            'imageable_type' => 'required|string',
            'alt' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Image::create([
            'path' => $path,
            'disk' => 'public',
            'mime_type' => $request->file('image')->getMimeType(),
            'imageable_id' => $request->imageable_id,
            'imageable_type' => $request->imageable_type,
            'alt' => $request->alt,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.images.index')->with('success', 'Imagen subida y creada exitosamente');
    }

    public function show(Image $image)
    {
        return view('administrador.images.show', compact('image'));
    }

    public function edit(Image $image)
    {
        return view('administrador.images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image' => 'nullable|image|max:4096',
            'imageable_id' => 'required|integer',
            'imageable_type' => 'required|string',
            'alt' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $data = [
            'imageable_id' => $request->imageable_id,
            'imageable_type' => $request->imageable_type,
            'alt' => $request->alt,
            'order' => $request->order ?? 0,
        ];

        if ($request->hasFile('image')) {
            if ($image->path) {
                \Illuminate\Support\Facades\Storage::disk($image->disk)->delete($image->path);
            }
            $path = $request->file('image')->store('images', 'public');
            $data['path'] = $path;
            $data['disk'] = 'public';
            $data['mime_type'] = $request->file('image')->getMimeType();
        }

        $image->update($data);

        return redirect()->route('admin.images.index')->with('success', 'Imagen actualizada exitosamente');
    }

    public function destroy(Image $image)
    {
        if ($image->path) {
            \Illuminate\Support\Facades\Storage::disk($image->disk)->delete($image->path);
        }
        $image->delete();

        return redirect()->route('admin.images.index')->with('success', 'Imagen y archivo físico eliminados exitosamente');
    }
}
