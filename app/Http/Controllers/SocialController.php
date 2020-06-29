<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\User;

class SocialController extends Controller
{
    public function __construct()
{
    $this->middleware('guest');
    
    if (request()->segment(1) == 'freelance') {
        if (request('provider') == 'facebook') {
            Config::set(['services.facebook.redirect' => 'https://localhost/marketing/public/freelance/callback/facebook']);
        } elseif (request('provider') == 'google') {
            Config::set(['services.google.redirect' => 'http://localhost/marketing/public/freelance/callback/google']);
        }
    } elseif (request()->segment(1) == 'student') {
        if (request('provider') == 'facebook') {
            Config::set(['services.facebook.redirect' => 'https://localhost/marketing/public/student/callback/facebook']);
        } elseif (request('provider') == 'google') {
            Config::set(['services.google.redirect' => 'http://localhost/marketing/public/student/callback/google']);
        }
    }
}

public function redirect($provider)
{
    return Socialite::driver($provider)->redirect();
}

 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user();
   $user = $this->createUser($getInfo,$provider);
   auth()->login($user); 
   return redirect('/');
 }

public function createUser($getInfo,$provider)
{
    $latest_ele = DB::table('users')->latest('created_at')->first();
    $latest_id = $latest_ele->id;
    $latest_id == null  ? 1 : $latest_id + 1;

    if (request()->segment(1) == 'freelance') 
    {
        $role = 'freelance';

    }elseif (request()->segment(1) == 'student') 
    {
        $role = 'student';

    }else {

        $role = 'user';
    }

    if ($getInfo->email) {
        $email = $getInfo->email;
    }else{
        $email = 'fake'. $getInfo->id .'@example.com';
    }

    $user = User::where('provider_id', $getInfo->id)->first();
    if (!$user) {
        $user = User::create([
            'name'        => $getInfo->name,
            'username'    => explode(" ", $getInfo->name)[0].'-'.Str::random(4) . $latest_id,
            'email'       => $email,
            'avatar'      => $getInfo->avatar,
            'password'    => Hash::make(Str::random(10)),
            'provider'    => $provider,
            'provider_id' => $getInfo->id,
            'role'        => $role
        ]);
    }
    return $user;
}
}
