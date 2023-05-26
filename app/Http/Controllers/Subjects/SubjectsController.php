<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teachers;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('Pages.Subjects.index' , compact('subjects'));
    }


    public function create()
    {
        $grades = Grade::all();
        $teachers = Teachers::all();
        return view('Pages.Subjects.add' , compact('grades' , 'teachers'));
    }

    public function store(Request $request)
    {
        try{

            $subject = new Subject();
            $subject->name = ['ar' => $request->name_ar , 'en' => $request->name_en];
            $subject->grade_id = $request->Grade_id;
            $subject->classroom_id = $request->Class_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();

            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Subjects.index');
    
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
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teachers::all();
        return view('Pages.Subjects.edit' , compact('subject' , 'grades' , 'teachers'));

    }

    public function update(Request $request)
    {
        try{

            $subject = Subject::findOrFail($request->id);
            $subject->name = ['ar' => $request->name_ar , 'en' => $request->name_en];
            $subject->grade_id = $request->Grade_id;
            $subject->classroom_id = $request->Class_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();

            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Subjects.index');
    
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $section = Subject::findOrFail($request->id)->delete();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Subjects.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
