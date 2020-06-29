<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class AIQ extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'a_i_qs';
protected $fillable = [
		'id',
		'admin_id',
		'instructor_id',
      'question_id',
      'answer_id',
		'created_at',
		'updated_at',
		'deleted_at',
   ];

protected $hidden = ['instructor_id'];

   public function instructor_id(){
      return $this->hasOne(\App\Instructor::class,'id','instructor_id');
   }

   public function question_id(){
      return $this->hasOne(\App\Model\Question::class,'id','question_id');
   }

   public function answer_id(){
      return $this->hasOne(\App\Model\Answer::class,'id','answer_id');
   }

}
