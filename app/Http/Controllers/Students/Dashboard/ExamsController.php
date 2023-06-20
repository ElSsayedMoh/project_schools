<?php

namespace App\Http\Controllers\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Quizzes;
use Illuminate\Http\Request;

class ExamsController extends Controller
{

    public function index()
    {
        $quizzes = Quizzes::where('grade_id', auth()->user()->grade_id)->where('classroom_id' , auth()->user()->classroom_id)
        ->where('section_id' , auth()->user()->section_id)->orderBy('id', 'DESC')->get();
        return view('Pages.Students.Dashboard.Exams.index' , compact('quizzes')); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($quizze_id)
    {
        $student_id = auth()->user()->id;
        return view('Pages.Students.Dashboard.Exams.show' , compact('quizze_id', 'student_id'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
