<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $materials = Material::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('title', 'like', '%' . $search . '%');
            }
        })
            ->latest()->paginate(6);

        return view('material', compact('materials', 'search'));
    }
}
