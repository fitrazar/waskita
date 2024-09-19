<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $quizzes = Quiz::all();

            return DataTables::of($quizzes)->make();
        }

        return view('admin.quiz.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'form' => 'required'
        ]);


        Quiz::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'form' => $validatedData['form'],
        ]);

        return redirect('/admin/quiz')->with('success', 'Quiz Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'form' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Quiz::findOrFail($quiz->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'form' => $validatedData['form'],
        ]);

        return redirect('/admin/quiz')->with('success', 'Quiz Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        Quiz::destroy($quiz->id);

        return redirect(to: '/admin/quiz')->with('success', 'Quiz Berhasil Dihapus!');
    }
}
