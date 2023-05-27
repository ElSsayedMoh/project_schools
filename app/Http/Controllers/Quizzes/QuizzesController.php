<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Quizzes;
use App\Models\Subject;
use App\Models\Teachers;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{

    public function index()
    {
        $quizzes = Quizzes::all();
        return view('Pages.Quizzes.index' , compact('quizzes'));
    }


    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teachers::all();
        return view('Pages.Quizzes.add', compact('grades', 'subjects' , 'teachers'));
        
    }


    public function store(Request $request)
    {
        try{
            $quizzes = new Quizzes();
            $quizzes->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();

            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Quizze.index');
    
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $quizz = Quizzes::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teachers::all();
        $grades = Grade::all();
        return view('Pages.Quizzes.edit' , compact('quizz' , 'subjects', 'teachers', 'grades'));
    }


    public function update(Request $request)
    {
        try{
            $quizzes = Quizzes::findOrFail($request->id);
            $quizzes->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();

            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Quizze.index');
    
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $quizzes = Quizzes::findOrFail($request->id)->delete();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Quizze.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
