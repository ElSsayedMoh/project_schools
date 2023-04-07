<?php

namespace App\Http\Controllers\Sections;

use App\Models\Sections;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Http\Requests\StoreSections;
use Illuminate\Http\RedirectResponse;
// use  Illuminate\Http\Request\StoreSections;
use Illuminate\Validation\Validator;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_grade = Grade::all();
        // return $Grades;
        return view('Pages.Sections.sections', compact('Grades', 'list_grade')); 
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
    public function store(StoreSections $request)
    {

        try {
            $validated = $request->validated();
            $Sections = new Sections() ;
            $Sections->name_section = ['ar' => $request->name_section_ar , 'en' => $request->name_section_en ];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->class_id;
            $Sections->status = 1 ;
            $Sections->save();

            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Sections.index');
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSections $request)
    {
        // return $request ;
        try{
            $validated = $request->validated();
            $section = Sections::findOrFail($request->id);
            $section->name_section = ['ar' => $request->name_section_ar , 'en' => $request->name_section_en];
            $section->grade_id = $request->Grade_id;
            $section->class_id = $request->class_id;

            if(isset($request->status)){
                $section->status = 1 ;
            }else {
                $section->status = 2 ;
            }
            $section->save();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $section = Sections::findOrFail($request->id)->delete();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('Sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getClasses($id){
        $list_classes = ClassRoom::where('grade_id', $id)->pluck('name_class', 'id');
        // return response()->json($list_classes);
        return $list_classes;
    }
}
