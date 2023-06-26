<?php

namespace App\Http\Controllers\Parents\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use App\Models\Degree;
use App\Models\feeInvoice;
use App\Models\Parents;
use App\Models\ReceiptStudents;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index(){
        $students = Students::where('parent_id' , auth()->user()->id)->get();
        return view('Pages.parents.children.index' , compact('students'));
    }

    public function results($id){
        $student = Students::findOrFail($id);
        if($student->parent_id == auth()->user()->id){
            $degrees = Degree::where('student_id', $id)->get();
            return view('Pages.parents.degrees.index' , compact('degrees'));
        }else {
            toastr()->error('خطأ فى كود الطالب');
            return redirect()->route('chlidren.index');
        }
    }

    public function attendances(){
        $students = Students::where('parent_id' , auth()->user()->id)->get();
        return view('Pages.parents.attendances.index' , compact('students'));
    }

    public function attendanceSearch(Request $request){
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
                $Students = Attendances::whereBetween('attendance_date', [$request->from, $request->to])->get();
            }else{
                $Students = Attendances::whereBetween('attendance_date', [$request->from, $request->to])->where('student_id' , $request->student_id)->get();
            }
            return view('Pages.parents.attendances.index',compact('Students','students'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function fees(){
        $student_ids = Students::where('parent_id' , auth()->user()->id)->pluck('id');
        $Fee_invoices = feeInvoice::whereIn('student_id' , $student_ids)->get();
        return view('Pages.parents.fees.index' , compact('Fee_invoices'));
    }

    public function receipt($id){
        $student = Students::findOrFail($id);

        if($student->parent_id !== auth()->user()->id){
                toastr()->error('خطأ فى كود الطالب');
                return redirect()->route('children.fees');
            }

        $receipt_students = ReceiptStudents::where('student_id' , $id)->get();

        if($receipt_students->isEmpty()){
            toastr()->error('لا توجد مدفوعات لهذا الطالب');
            return redirect()->route('children.fees');
        }
        return view('Pages.parents.receipt.index' , compact('receipt_students'));
    }

    public function profile_parent(){
        $information = Parents::findOrFail(auth()->user()->id);
        return view('Pages.parents.profile' , compact('information'));
    }

    public function update_parent_profile(Request $request , $id){
        try{
            $information = Parents::findOrFail($id);
            $information->name_father = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            if(!empty($request->password)){
                $information->password = Hash::make($request->password);
            }
            $information->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('profile_parent.show');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
