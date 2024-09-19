<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $quizzes = Quiz::all();

            return DataTables::of($quizzes)->make();
        }

        return view('quiz');
    }
}
