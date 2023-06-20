<?php

namespace App\Http\Controllers\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Students::findOrFail(auth()->user()->id);
        return view('Pages.Students.Dashboard.profile' , compact('information'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try{
            $information = Students::findOrFail($id);
            $information->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            if(!empty($request->password)){
                $information->password = Hash::make($request->password);
                
            }
            $information->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('student_profile.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
