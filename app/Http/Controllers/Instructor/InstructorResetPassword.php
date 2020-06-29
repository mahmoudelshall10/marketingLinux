<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Instructor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class InstructorResetPassword extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest:instructor');
        // $this->middleware('instructor_guest:instructor');
    }


    /**
     * Where to redirect instructors after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/instructor';


    public function broker()
    {
        return Password::broker('instructors');
    }
        /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('instructor.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );

        // return redirect('/instructor');
    }
}
