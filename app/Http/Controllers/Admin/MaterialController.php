<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $materials = Material::all();

            return DataTables::of($materials)->make();
        }

        return view('admin.material.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|max:4098',
            'file' => 'required|file|mimes:pdf|max:8098',
            'type' => 'required',
            'excerpt' => 'required|string|max:255'
        ]);

        $fileFilename = NULL;
        if ($request->hasFile('cover')) {
            $fileFilename = time() . '.' . $request->file('cover')->getClientOriginalExtension();
            $coverPath = $request->file('cover')->storeAs('material/cover', $fileFilename);
        }
        $fileFilename2 = NULL;
        if ($request->hasFile('file')) {
            $fileFilename2 = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('material/file', $fileFilename2);
        }

        Material::create([
            'title' => $validatedData['title'],
            'excerpt' => $validatedData['excerpt'],
            'type' => $validatedData['type'],
            'cover' => $fileFilename ?? NULL,
            'file' => $fileFilename2 ?? NULL,
        ]);

        return redirect('/admin/material')->with('success', 'Materi Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('admin.material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|max:4098',
            'file' => 'nullable|file|mimes:pdf|max:8098',
            'type' => 'required',
            'excerpt' => 'required|string|max:255'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['cover'] = $request->oldImage;
        if ($request->file('cover')) {
            $path = 'material/cover';
            if ($request->oldImage) {
                Storage::delete($path . '/' . $request->oldImage);
            }
            $validatedData['cover'] = time() . '.' . $request->file('cover')->getClientOriginalExtension();
            $coverPath = $request->file('cover')->storeAs('material/cover', $validatedData['cover']);
        }

        $validatedData['file'] = $request->oldFile;
        if ($request->file('file')) {
            $path = 'material/file';
            if ($request->oldFile) {
                Storage::delete($path . '/' . $request->oldFile);
            }
            $validatedData['file'] = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('material/file', $validatedData['file']);
        }


        Material::findOrFail($material->id)->update([
            'title' => $validatedData['title'],
            'type' => $validatedData['type'],
            'excerpt' => $validatedData['excerpt'],
            'cover' => $validatedData['cover'],
            'file' => $validatedData['file']
        ]);

        return redirect('/admin/material')->with('success', 'Materi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        if ($material->cover) {
            Storage::delete('material/cover/' . $material->cover);
        }
        if ($material->file) {
            Storage::delete('material/file/' . $material->file);
        }

        Material::destroy(ids: $material->id);

        return redirect(to: '/admin/material')->with('success', 'Materi Berhasil Dihapus!');
    }
}
