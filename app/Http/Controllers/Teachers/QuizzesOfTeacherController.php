<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizzes;
use App\Models\Sections;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzesOfTeacherController extends Controller
{
    protected $teacher_id ;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->teacher_id = Auth::user()->id;
    
            return $next($request);
        });
    }

    public function index()
    {
        $quizzes = Quizzes::where('teacher_id' , $this->teacher_id)->get();
        return view('Pages.Teachers.Quizzes.index' , compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id' , $this->teacher_id)->get();
        return view('Pages.Teachers.Quizzes.add' , $data);
    }


    public function store(Request $request)
    {
        try{

            $quizzes = new Quizzes();
            $quizzes->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id_teacher;
            $quizzes->classroom_id = $request->Classroom_id_teacher;
            $quizzes->section_id = $request->section_id_teacher;
            $quizzes->teacher_id = $this->teacher_id;
            $quizzes->save();

            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('quizzes.index');
    
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizzes::findorFail($id);
        return view('Pages.Teachers.Dashboard.Questions.index' , compact('quizz' , 'questions'));
    }


    public function edit($id)
    {
        $quizz = Quizzes::findOrFail($id);
        $subjects = Subject::all();
        $grades = Grade::all();
        return view('Pages.Teachers.Quizzes.edit' , compact('quizz' , 'subjects', 'grades'));
    }


    public function update(Request $request)
    {
        try{
            $quizzes = Quizzes::findOrFail($request->id);
            $quizzes->name = ['ar' => $request->Name_ar , 'en' => $request->Name_en];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id_teacher;
            $quizzes->classroom_id = $request->Classroom_id_teacher;
            $quizzes->section_id = $request->section_id_teacher;
            $quizzes->teacher_id = $this->teacher_id;
            $quizzes->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('quizzes.index');
    
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try{
            $quizzes = Quizzes::findOrFail($request->id)->delete();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->route('quizzes.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function getClassroomTeacher(Request $request){
        $list_classes = ClassRoom::where('grade_id', $request->id)->pluck('name_class', 'id');
        return $list_classes;
    }

    public function getSectionTeacher(Request $request){
        $id = $request->get('id');
        $section = Sections::where('class_id' , $id)->pluck('name_section','id');
        return $section ;
    }
}
