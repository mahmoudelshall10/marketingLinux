<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class Answer extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'answers';
protected $fillable = [
		'id',
		'admin_id',
	    'question_id',
		'answer_ar',
		'answer_en',
		'question_id',
		'created_at',
		'updated_at',
		'deleted_at',
	];

   public function question_id(){
      return $this->belongsTo(\App\Model\Question::class);
   }

}
