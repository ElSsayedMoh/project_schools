<?php

namespace App\Http\Livewire\Students;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $student_id , $quizze_id , $data , $counter = 0 ,$questionCount = 0 ;

    public function render()
    {
        $this->data = Question::where('quizze_id' , $this->quizze_id)->get();
        $this->questionCount = $this->data->count();
        return view('livewire.students.show-question', ['data']);
    }

    public function nextQuestion($question_id , $score , $answer , $right_answer){

        $student_degree = Degree::where('student_id' , $this->student_id)->where('quizzes_id' , $this->quizze_id)->first();

        if($student_degree == null){
            $degree = new Degree();
            $degree->quizzes_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;

            if(strcmp(trim($answer), trim($right_answer)) === 0){
                $degree->score += $score;
            }else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
        }else {
            // update
            if($student_degree->question_id >= $this->data[$this->counter]->id){
                $student_degree->score = 0;
                $student_degree->abuse = '1';
                $student_degree->save();
                toastr()->error('تم إلغاء الإختبار لإكتشاف تلاعب بالنظام');
                return redirect('student_exams');
            }else {
                $student_degree->question_id = $question_id;
                if(strcmp(trim($answer), trim($right_answer)) === 0){
                    $student_degree->score += $score;
                }else {
                    $student_degree->score += 0;
                }
                $student_degree->save();
            }
        }

        if($this->counter < $this->questionCount - 1){
            $this->counter++;
        } else {
            toastr()->success('تم إجراء الإختبار بنجاح');
            return redirect('student_exams');
        }
    }
}
