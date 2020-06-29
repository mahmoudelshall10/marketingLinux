<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\InstructorQuestionAnswer;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class InstructorQuestionAnswersApi extends Controller
{

            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
               return response()->json([
               "status"=>true,
               "data"=>InstructorQuestionAnswer::orderBy('id','desc')->paginate(15)
               ]);
            }


            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * Store a newly created resource in storage. Api
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
    public function store()
    {
        $rules = [
                         'question_id'=>'required|numeric',
             'answer_id'=>'required|numeric',
             'instructor_id'=>'required|numeric',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'question_id'=>trans('admin.question_id'),
             'answer_id'=>trans('admin.answer_id'),
             'instructor_id'=>trans('admin.instructor_id'),
        ]);
		
        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]); 
             }
        $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id; 
        $create = InstructorQuestionAnswer::create($data); 

        return response()->json([
            "status"=>true,
            "message"=>trans('admin.added'),
            "data"=>$create
        ]);
    }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $show =  InstructorQuestionAnswer::find($id);
                 return response()->json([
              "status"=>true,
              "data"=> $show
              ]);  ;
            }


            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [
             'question_id'=>'required|numeric',
             'answer_id'=>'required|numeric',
             'instructor_id'=>'required|numeric',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'question_id'=>trans('admin.question_id'),
             'answer_id'=>trans('admin.answer_id'),
             'instructor_id'=>trans('admin.instructor_id'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]); 
             }
             $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id; 
              InstructorQuestionAnswer::where('id',$id)->update($data);

              $InstructorQuestionAnswer = InstructorQuestionAnswer::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $InstructorQuestionAnswer
               ]);
            }

            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $instructorquestionanswers = InstructorQuestionAnswer::find($id);


               @$instructorquestionanswers->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$instructorquestionanswers = InstructorQuestionAnswer::find($id);

                    	@$instructorquestionanswers->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $instructorquestionanswers = InstructorQuestionAnswer::find($data);
 

                    @$instructorquestionanswers->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }

            
}