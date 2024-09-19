<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Material;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->paginate(3);
        $videos = Video::latest()->paginate(3);
        return view('dashboard', compact('materials', 'videos'));
    }

    public function fetchMaterials(Request $request)
    {
        $type = $request->input('type');

        $query = Material::query();

        if ($type) {
            if ($type == 'All') {
                $query->whereIn('type', [0, 1]);
            } elseif ($type == 'PPT') {
                $query->where('type', 0);
            } elseif ($type == 'Artikel') {
                $query->where('type', 1);
            }
        }

        $materials = $query->paginate(3);

        return response()->json([
            'materials' => view('partials.materials', compact('materials'))->render(),
        ]);
    }

    public function fetchVideos(Request $request)
    {
        $videos = Video::paginate(3);

        return response()->json([
            'videos' => view('partials.videos', compact('videos'))->render(),
        ]);
    }


    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $materials = Material::where('title', 'like', "%{$searchQuery}%")->get();
        $videos = Video::where('title', 'like', "%{$searchQuery}%")->get();

        return response()->json([
            'materials' => view('partials.materials', compact('materials'))->render(),
            'videos' => view('partials.videos', compact('videos'))->render()
        ]);
    }



}
