<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/active', function () {
        return view('active');
    });


Auth::routes();

Route::get('/user', 'HomeController@index')->name('home');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

// chatting
    Route::get('/chat', 'ChatsController@index');
    Route::get('/messages', 'ChatsController@fetchMessages');
    Route::post('/messages', 'ChatsController@sendMessage');
// chatting
//--------------------instructor-------------------//
Route::group(['prefix' => 'instructor'], function () {    

    Route::group(['namespace' => 'Instructor'], function () {
        //=============InstructorLogin=============//
        Route::get('/login', 'InstructorLogin@showInstructorLoginForm');
        Route::post('/login', 'InstructorLogin@instructorLogin')->name('InstructorLogin');
        //=============InstructorLogin=============//
        Route::get('/auth/redirect/{provider}', 'InstructorSocialController@redirect');
        Route::get('/callback/{provider}', 'InstructorSocialController@callback');
        Route::get('signup/activate/{token}', 'InstructorRegister@signupActivate');
        //=============InstructorRegister=============//
        Route::get('/register', 'InstructorRegister@showInstructorRegisterForm');
        Route::post('/register', 'InstructorRegister@createInstructor')->name('InstructorRegister');
        Route::get('signup/activate/{token}', 'InstructorRegister@signupActivate');
        //=============InstructorRegister=============//
        
        //=============InstructorForgotPassword=============//
        Route::get('password/reset', 'InstructorForgotPassword@showLinkRequestForm')->name('instructor.password.request');
        Route::post('password/email', 'InstructorForgotPassword@sendResetLinkEmail')->name('instructor.password.email');
        //=============InstructorForgotPassword=============//
        
        //=============InstructorResetPassword=============//
        Route::get('password/reset/{token}', 'InstructorResetPassword@showResetForm')->name('instructor.password.reset');
        Route::post('password/reset', 'InstructorResetPassword@reset')->name('instructor.password.update');
        //=============InstructorResetPassword=============//
        
        
        Route::group(['middleware' => ['auth:instructor']], function () {
            
            //=============InstructorHome=============//
            Route::get('/', 'InstructorHome@index')->name('InstructorHome');
            Route::post('/logout', 'InstructorHome@logout')->name('instructor.logout');
            //=============InstructorHome=============//
            
            //===========InstructorQuestion===============//
            
            Route::get('/allquestions', 'InstructorQuestion@allQuestions');
            Route::get('/allanswers', 'InstructorQuestion@allAnswers');

            Route::post('/', 'InstructorQuestion@questionCreate')->name('InstructorQuestions.store');

            Route::get('/getquestions/{id}', 'InstructorQuestion@getQuestion');
            Route::get('/getanswers/{id}', 'InstructorQuestion@getAnswer');

            //===========InstructorQuestion===============//
        });
    });
});

//--------------------student-------------------//
Route::group(['prefix' => 'student'], function () {
    Route::get('/auth/redirect/{provider}','SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');
        // Route::get('signup/activate/{token}', 'RegisterController@signupActivate');
        Route::group(['namespace' => 'Student'], function () { 
            Route::group(['middleware' => 'can:isStudent'], function () {
                Route::get('/', 'StudentHome@index')->name('StudentHome');
            });        
        });
});

//--------------------Freelance-------------------//
Route::group(['prefix' => 'freelance'], function () {
        Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
        Route::get('/callback/{provider}', 'SocialController@callback');
        // Route::get('signup/activate/{token}', 'InstructorRegister@signupActivate');
        Route::group(['namespace' => 'Freelance'], function () { 
            Route::group(['middleware' => 'can:isFreelance'], function () {
                Route::get('/', 'FreelanceHome@index')->name('FreelanceHome');
            });        
        });
});


