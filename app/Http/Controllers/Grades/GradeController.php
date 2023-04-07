<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\ClassRoom;
class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('Pages.Grades.Grades', compact('grades'));
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
    public function store(StoreGrades $request)
    {

        if(Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()){
            return redirect()->back()->withErrors(trans('trans_school.Name_Repeated'));
        }

        try{
            $validated = $request->validated();
            $grade = new Grade() ;
            $grade->name = ['en' => $request->name_en , 'ar' => $request->name_ar ];
            $grade->notes = $request->Notes;
            $grade->save();
    
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Grade.index');
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrades $request, Grade $grade)
    {   

        try{
            $validated = $request->validated();
            $id = $request->id;
            $grade = Grade::findOrFail($id);
            $grade->update([
                    $grade->name = ['ar' => $request->name_ar , 'en' => $request->name_en],
                    $grade->notes = $request->note,
                ]);
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Grade.index');
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $id = $request->id;
            $class_room = ClassRoom::where('grade_id',$id)->pluck('grade_id');
            if($class_room->count() == 0){
                $grade = Grade::findOrFail($id)->delete();
                toastr()->success(trans('trans_school.Success'));
                return redirect()->route('Grade.index');
            }else {
                toastr()->error(trans('trans_school.cannot_be_deleted'));
                return redirect()->route('Grade.index');
            }

        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
}
