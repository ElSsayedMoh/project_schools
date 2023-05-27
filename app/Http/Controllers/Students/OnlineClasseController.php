<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\OnlineClasse;
use Illuminate\Http\Request;
use App\Http\Traits\MeetingZoomTrait;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClasseController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = OnlineClasse::all();
        return view('Pages.onlineClasses.index' , compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('Pages.onlineClasses.add' , compact('Grades'));
    }

    public function offLineCreate(){
        $Grades = Grade::all();
        return view('Pages.onlineClasses.off_line' , compact('Grades'));
    }


    public function store(Request $request)
    {
        try {
            $meeting = $this->createMeeting($request);
            OnlineClasse::create([
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function offLineStore(Request $request){
        try {
            OnlineClasse::create([
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
        //
    }


    public function destroy(Request $request)
    {
        try {
            $meeting = Zoom::meeting()->find($request->id);
            $meeting->delete();
            OnlineClasse::where('meeting_id', $request->id)->delete();

            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('online_classes.index');

        }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
