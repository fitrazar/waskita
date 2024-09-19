<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $videos = Video::all();

            return DataTables::of($videos)->make();
        }

        return view('admin.video.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,mkv|max:16000',
        ]);

        $fileFilename = NULL;
        if ($request->hasFile('video')) {
            $fileFilename = time() . '.' . $request->file('video')->getClientOriginalExtension();
            $videoPath = $request->file('video')->storeAs('video', $fileFilename);
        }

        Video::create([
            'title' => $validatedData['title'],
            'video' => $fileFilename ?? NULL,
        ]);

        return redirect('/admin/video')->with('success', 'Video Edukasi Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,mkv|max:16000',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['video'] = $request->oldVideo;
        if ($request->file('video')) {
            $path = 'video';
            if ($request->oldVideo) {
                Storage::delete($path . '/' . $request->oldVideo);
            }
            $validatedData['video'] = time() . '.' . $request->file('video')->getClientOriginalExtension();
            $videoPath = $request->file('video')->storeAs('video', $validatedData['video']);
        }



        Video::findOrFail($video->id)->update([
            'title' => $validatedData['title'],
            'video' => $validatedData['video'],
        ]);

        return redirect('/admin/video')->with('success', 'Video Edukasi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        if ($video->video) {
            Storage::delete('video/' . $video->video);
        }
        Video::destroy($video->id);
        return redirect(to: '/admin/video')->with('success', 'Video Edukasi Berhasil Dihapus!');
    }
}
