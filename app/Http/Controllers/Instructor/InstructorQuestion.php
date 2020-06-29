<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Model\AIQ;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Model\Answer;
use App\Model\Question;
class InstructorQuestion extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }
    
    public function allQuestions()
    {
        $questions = Question::orderBy('id')->with('answer')->get();
        return response($questions,200);
    }

    public function allAnswers()
    {
        $answers = Answer::orderBy('id')->get();
        return response($answers,200);
    }
    public function questionCreate()
    {
        if(request()->ajax()){
        $answer = $this->validate(request(),[
                    'question_id' => 'required|numeric',
                    'answer_id' => 'required|numeric',
                    'instructor_id' => 'required|numeric',
                ],[],[
                    'question_id' => trans('instructor.question_id'),
                    'answer_id' => trans('instructor.answer_id'),
                    'instructor_id' => trans('instructor.instructor_id'),
                ]);
                $answer['question_id'] = request('question_id');
                $answer['answer_id'] = request('answer_id');
                $answer['instructor_id'] = auth()->guard('instructor')->id();
            AIQ::create($answer);
            return response($answer,200); 
        }
    }

    public function getQuestion($question_id)
    {
        $question = Answer::where('question_id',$question_id)->get();
        return response($question,200);
    }

    public function getAnswer($answer_id)
    {
        $answer = Answer::where('id' , '=', $answer_id)->with('question_id')->get();
        return response($answer,200);
    }
}
