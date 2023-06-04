<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $information = Teachers::findOrFail(auth()->user()->id);
        return view('Pages.Teachers.Dashboard.profile' , compact('information'));
    }

    public function update(Request $request , $id){
        
        try{
            $information = Teachers::findOrFail($id);
            $information->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            if(!empty($request->password)){
                $information->password = Hash::make($request->password);
                
            }
            $information->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('profile_teacher.show');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
