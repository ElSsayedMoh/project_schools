<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsGraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Students::onlyTrashed()->get();
        return view('Pages.Students.list_graduate' , compact('students'));

    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Pages.Students.graduate' , compact('Grades'));
    }

    public function store(Request $request)
    {
        $students = Students::where('grade_id' , $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        if($students->count() < 1){
            return redirect()->back()->with('error_promotions', __(trans('trans_school.There_is_no_data_in_the_students_table')));
        }

        foreach($students as $student) {
            $ids = explode(',', $student->id);
            Students::whereIn('id' , $ids)->delete();
        }

        DB::commit();
        toastr()->success(trans('trans_school.Success'));
        return redirect()->route('StudentsGraduate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student = Students::onlyTrashed()->where('id' , $request->id)->first()->restore();
        toastr()->error(trans('trans_school.Success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Students::onlyTrashed()->where('id' , $request->id)->first()->forceDelete();
        toastr()->error(trans('trans_school.Success'));
        return redirect()->back();
    }
}
