<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use App\Models\ClassRoom;
use App\Models\Sections;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsOfTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $students = Students::whereIn('section_id' , $ids)->get();
        return view('Pages.Teachers.Dashboard.Students.index' , compact('students'));
    }

    public function section(){
        $ids = DB::table('teachers_sections')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $sections = Sections::whereIn('id' , $ids)->get();
        return view('Pages.Teachers.Dashboard.Sections.index' , compact('sections'));
    }

    public function attendance_store(Request $request){
        try{
            $attend_date = date('Y-m-d');
    
            foreach($request->attendences as  $student_id => $attendance){
    
                if($attendance == 'presence'){
                    $attendance_status = true;
                } else if($attendance == 'absent'){
                    $attendance_status = false;
                }
    
                Attendances::updateOrCreate(['student_id' => $student_id , 'attendance_date' => $attend_date],[
                    'student_id' => $student_id,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => auth()->user()->id,
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

    public function report_attendance(){
        $ids = DB::table('teachers_sections')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $students = Students::whereIn('section_id' , $ids)->get();
        return view('Pages.Teachers.Dashboard.Students.report_attendance' , compact('students'));
    }

    public function attendance_search(Request $request) {

        $validated = $request->validate([
            'from'  =>'required|date|date_format:Y-m-d',
            'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
        ],[
            'to.after_or_equal' => 'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        try{
        $ids = DB::table('teachers_sections')->where('teacher_id' , auth()->user()->id)->pluck('section_id');
        $students = Students::whereIn('section_id' , $ids)->get();

            if($request->student_id == 0){
                $Students = Attendances::whereBetween('attendance_date', [$request->from, $request->to])->where('teacher_id', auth()->user()->id)->get();
            }else{
                $Students = Attendances::whereBetween('attendance_date', [$request->from, $request->to])->where('student_id',$request->student_id)->get();
            }
            return view('Pages.Teachers.Dashboard.Students.report_attendance',compact('Students','students'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
