<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InstructorResetPasswordNotification;
use App\Model\Question;
use Illuminate\Database\Eloquent\SoftDeletes;
class Instructor extends Authenticatable
{
    use Notifiable;
	use SoftDeletes;
    protected $table    = 'instructors';
    protected $guard    = 'instructor';
	protected $dates    = ['deleted_at'];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new InstructorResetPasswordNotification($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','activation_token' ,'account_status' ,'provider', 'provider_id' , 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_token'
    ];

    public function question()
    {
        return $this->belongsToMany(Question::class , 'question_id');
    }
}