<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class InstructorLogin extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/instructor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:instructor')->except('logout');
    }


    public function showInstructorLoginForm()
    {
        return view('instructor.login', ['url' => 'instructor']);
    }

    public function instructorLogin()
    {
        // dd(auth()->guard('instructor'));
        $fieldType = filter_var(request('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($fieldType == 'email'){
            $this->validate(request(), [
                'username'   => 'required|string|email|max:255',
                'password'   => 'required|string|min:6'
            ]);
        }elseif($fieldType == 'username'){
            $this->validate(request(), [
                'username'   => 'required|string|max:30',
                'password'   => 'required|string|min:6'
            ]);
        }
        if (auth()->guard('instructor')->attempt([$fieldType => request()->username, 'password' => request()->password,'account_status' => 1], request()->get('remember'))) {
            return redirect('/instructor');
        }
        return back()->withInput(request()->only($fieldType, 'remember'));
    }
}
