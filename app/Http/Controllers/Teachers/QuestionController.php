<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizzes;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try{
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizz_id;
            $question->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->back();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $quizz_id = $id;
        return view('Pages.Teachers.Dashboard.Questions.add' , compact('quizz_id'));
    }


    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('Pages.Teachers.Dashboard.Questions.edit' , compact('question'));
    }


    public function update(Request $request , $id)
    {
        try{
            $question = Question::findOrfail($id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('quizzes.show' , $question->quizze_id);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            Question::findOrFail($request->id)->delete();
            toastr()->success(message: trans('trans_school.Success'));
            return redirect()->back();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }    }
}
