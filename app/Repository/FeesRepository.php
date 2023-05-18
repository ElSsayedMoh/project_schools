<?php

namespace App\Repository;

use App\Models\Fees;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface {

    public function index() {
        $fees = Fees::all();
        return view('Pages.Fees.index' , compact('fees'));
    }

    public function create() {
        $Grades = Grade::all();
        return view('Pages.Fees.add' , compact('Grades'));
    }

    public function store($request)
    {
        try{
            $fees = new Fees();
            $fees->title = ['ar' => $request->title_ar , 'en' => $request->title_en];
            $fees->amount = $request->amount ;
            $fees->grade_id = $request->Grade_id  ;
            $fees->classroom_id  = $request->Classroom_id ;
            $fees->description = $request->description ;
            $fees->year = $request->year ;
            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        $fee = Fees::findOrFail($id);
        $Grades = Grade::all();
        return view('Pages.Fees.edit' , compact('fee', 'Grades'));
    }

    public function update($request){
        try{
            $fee = Fees::findOrFail($request->id);
            $fee->title = ['ar' => $request->title_ar , 'en' => $request->title_en];
            $fee->amount = $request->amount;
            $fee->grade_id = $request->grade_id;
            $fee->classroom_id = $request->Classroom_id;
            $fee->year = $request->year;
            $fee->description = $request->description;
            $fee->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.index');
            // return $request ;
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try{
            $fee = Fees::findOrFail($request->id)->delete();
            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}