<?php

namespace App\Repository;

use App\Models\Genders;
use App\Models\Specializations;
use App\Models\Teachers;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        $teachers = Teachers::all();
        return $teachers;
    }
    public function getGender(){
        $gender = Genders::all();
        return $gender;
    }

    public function getSpecialization(){
        $special = Specializations::all();
        return $special;
    }

    public function storeTeacher($request){
        try{
            // $validated = $request->validated();
            $teacher = new Teachers();
            $teacher->email = $request->Email;
            $teacher->password =  Hash::make($request->Password);
            $teacher->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;
            $teacher->joining_date = $request->Joining_Date;
            $teacher->address = $request->Address;
            $teacher->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Teachers.create');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function EditTeacher($id){
            return Teachers::findOrFail($id);
    }

    public function UpdateTeacher($request){
        try{
            $teacher = Teachers::findOrFail($request->id);
            $teacher->email = $request->Email;
            $teacher->password =  Hash::make($request->Password);
            $teacher->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;
            $teacher->joining_date = $request->Joining_Date;
            $teacher->address = $request->Address;
            $teacher->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Teachers.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}