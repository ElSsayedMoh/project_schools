<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teachers;
use App\Repository\TeacherRepositoryInterface;
use App\Http\Requests\StoreTeachers;
use Illuminate\Validation\Validator;

class TeachersController extends Controller
{

    protected $Teachers ;
    public function __construct(TeacherRepositoryInterface $teachers){
        $this->Teachers = $teachers;
    }
    
    public function index()
    {
        $teachers =  $this->Teachers->getAllTeachers(); 
        return view('Pages.Teachers.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Gender = $this->Teachers->getGender();
        $Specialization = $this->Teachers->getSpecialization();
        return view('Pages.Teachers.add_teacher', compact('Gender', 'Specialization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachers $request)
    {

        return $this->Teachers->storeTeacher($request);
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
        $Teacher = $this->Teachers->EditTeacher($id);
        $Gender = $this->Teachers->getGender();
        $Specialization = $this->Teachers->getSpecialization();
        return view('Pages.Teachers.edit_teacher', compact('Teacher' , 'Gender' , 'Specialization'));
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
        return $this->Teachers->UpdateTeacher($request);
        // return $request ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Teachers::findOrFail($request->id)->delete();
        toastr()->error(trans('trans_school.Success'));
        return redirect()->route('Teachers.index');
    }
}
