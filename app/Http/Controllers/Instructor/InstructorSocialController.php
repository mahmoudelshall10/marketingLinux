<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instructor;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class InstructorSocialController extends Controller
{

public function __construct()
{
    $this->middleware('guest:instructor');
    
    if(request('provider') == 'facebook'){  
        Config::set(['services.facebook.redirect' => 'https://localhost/marketing/public/instructor/callback/facebook']);
    }elseif(request('provider') == 'google'){
        Config::set(['services.google.redirect' =>'http://localhost/marketing/public/instructor/callback/google']);
    } 
}

public function redirect($provider)
{
    return Socialite::driver($provider)->redirect();
}

 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user();
   $instructor = $this->createInstructor($getInfo,$provider);
   auth()->guard('instructor')->login($instructor); 
   return redirect('/instructor');
 }

 function createInstructor($getInfo,$provider)
 {
    $latest_ele = DB::table('instructors')->latest('created_at')->first();
    $latest_id = $latest_ele->id;
    $latest_id == null  ? 1 : $latest_id + 1;

    if ($getInfo->email) {
        $email = $getInfo->email;
    } else {
        $email = 'fake'. $getInfo->id .'@example.com';
    }
    $instructor = Instructor::where('provider_id', $getInfo->id)->first();
    if (!$instructor) {
        $instructor = Instructor::create([
            'name'        => $getInfo->name,
            'username'    => explode(" ", $getInfo->name)[0].'-'.Str::random(4) . $latest_id,
            'email'       => $email,
            'avatar'      => $getInfo->avatar,
            'password'    => Hash::make(Str::random(10)),
            'provider'    => $provider,
            'provider_id' => $getInfo->id
        ]);
    }
    return $instructor;
}
}
