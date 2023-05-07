<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Sections;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('Pages.Students.promotion' , compact('Grades'));
    }
    
    public function getClassroom(Request $request){
        $id = $request->get('id');
        $classroom = ClassRoom::where('grade_id' , $id)->pluck('name_class','id');
        return $classroom ;
    }

    public function getSection(Request $request){
        $id = $request->get('id');
        $section = Sections::where('class_id' , $id)->pluck('name_section','id');
        return $section ;
        
    }


    public function create()
    {
        $pormotions = Promotion::all();
        return view('Pages.Students.list_promotion' , compact('pormotions'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        $students = Students::where('grade_id' , $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_promotions', __(trans('trans_school.There_is_no_data_in_the_students_table')));
        }

        foreach($students as $student) {

            $ids = explode(',', $student->id);

            Students::whereIn('id' , $ids)->update([
                'grade_id' => $request->Grade_id_new,
                'classroom_id' => $request->Classroom_id_new,
                'section_id' => $request->section_id_new,
            ]);

            Promotion::updateOrCreate([
                'student_id' => $student->id,
                'from_grade' => $request->Grade_id,
                'from_classroom' => $request->Classroom_id,
                'from_section' => $request->section_id,
                'to_grade' => $request->Grade_id_new,
                'to_classroom' => $request->Classroom_id_new,
                'to_section' => $request->section_id_new,
            ]);
        }

        DB::commit();
        toastr()->success(trans('trans_school.Success'));
        return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
    public function destroy(Request $request)
    {

        try {

            if($request->page_id == 1){

                $pormotions = Promotion::all();

                foreach($pormotions as $promotion){
                    
                    $ids = explode(',', $promotion->student_id);

                    Students::whereIn('id' , $ids)->update([
                        'grade_id' => $promotion->from_grade,
                        'classroom_id' => $promotion->from_classroom,
                        'section_id' => $promotion->from_section,
                    ]);

                    Promotion::truncate();
                    }
                    DB::commit();
                    toastr()->error(trans('trans_school.Success'));
                    return redirect()->back();
                }

            else {
                $promotion = Promotion::where('id' , $request->id)->first();
                Students::where('id' , $promotion->student_id)->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_classroom,
                    'section_id' => $promotion->from_section,
                ]);

                $promotion->delete();
                DB::commit();
                toastr()->error(trans('trans_school.Success'));
                return redirect()->back();
            }

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    
}
}