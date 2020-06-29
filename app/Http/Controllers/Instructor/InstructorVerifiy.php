<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class InstructorVerifiy extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }

    public function index()
    {
        return view('instructor.instructorVerifiy');
    }
}
