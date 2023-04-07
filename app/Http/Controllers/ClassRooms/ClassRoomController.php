<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\StoreClasses;
use Illuminate\Support\Facades\Validator;


class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ClassRooms = ClassRoom::all();
        $Grades = Grade::all();
        return view('Pages.ClassRooms.classrooms', compact('ClassRooms', 'Grades'));
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
    public function store(Request $request )
    {

        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
        ] , [
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
        ]);
        
        $List_Classes = $request->List_Classes;
        try{
            foreach($List_Classes as $List_Class){
                $My_Classes = new ClassRoom();
                $My_Classes->name_class = ['en' => $List_Class['name_en'], 'ar' => $List_Class['name_ar']];
                $My_Classes->grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('ClassRooms.index');
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        try{

            $validator = Validator::make($request->all(), [
                'name_ar' => 'required',
                'name_en' => 'required',
            ] , [
                'name_ar.required' => trans('validation.required'),
                'name_en.required' => trans('validation.required'),
            ]);

            $id = $request->id;
            $ClassRoom = ClassRoom::findOrFail($id);
            $ClassRoom-> update([
                $ClassRoom->name_class = ['ar' => $request->name_ar , 'en' => $request->name_en],
                $ClassRoom->grade_id = $request->Grade_id,
            ]);
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('ClassRooms.index');
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ClassRoom $classRoom )
    {

        try {
            $id = $request->id;
            $ClassRoom = ClassRoom::findOrFail($id)->delete();
            toastr()->error(trans('trans_school.Success'));
            return redirect()->route('ClassRooms.index');
        } 
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete_all(Request $request){
        $delete_all = explode(',',$request->id);
        ClassRoom::whereIn('id',$delete_all)->delete();
        toastr()->error(trans('trans_school.Success'));
        return redirect()->route('ClassRooms.index');
    }

    public function search_grade(Request $request){

        $grade_id = $request->grade_id_search;
        $Grades = Grade::all();
        $search_grade = ClassRoom::where('grade_id', $grade_id)->get();
        // return view('Pages.ClassRooms.classrooms', compact('Grades', 'search_grade'));
        return response()->json($search_grade);



    }
}
