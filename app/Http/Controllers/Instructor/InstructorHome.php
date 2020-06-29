<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Model\AIQ;
use App\Model\Answer;
use App\Model\Question;
use Illuminate\Support\Facades\Auth;
class InstructorHome extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = Question::orderBy('id')->get();
        $answers = Answer::orderBy('id')->get();
        $instructor = AIQ::whereNotNull('instructor_id')->first();
        return view('instructor.instructorHome',compact('questions','answers','instructor'));
    }


    public function logout(Request $request)
    {
        auth()->guard('instructor')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->guest(url('/'));
    }
}
