<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videos = Video::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('title', 'like', '%' . $search . '%');
            }
        })
            ->latest()->paginate(6);

        return view('video', compact('videos', 'search'));
    }
}
