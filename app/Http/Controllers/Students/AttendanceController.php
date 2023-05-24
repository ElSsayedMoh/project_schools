<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use App\Models\Grade;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_grades = Grade::all();
        $teachers = Teachers::all();
        return view('Pages.Attendance.Sections' , compact('Grades', 'list_grades' , 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $attend_date = date('Y-m-d');

        foreach($request->attendences as  $student_id => $attendance){

            if($attendance == 'presence'){
                $attendance_status = true;
            } else if($attendance == 'absent'){
                $attendance_status = false;
            }

            Attendances::create([
                'student_id' => $student_id,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'attendance_date' => $attend_date,
                'attendance_status' => $attendance_status
            ]);
        }
        toastr()->success(trans('trans_school.Success'));
        return redirect()->back();

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $students = Students::with('attendance')->where('section_id', $id)->get();;
        return view('Pages.Attendance.index' , compact('students'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
