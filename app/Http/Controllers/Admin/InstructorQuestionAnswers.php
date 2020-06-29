<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\InstructorQuestionAnswersDataTable;
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
class InstructorQuestionAnswers extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(InstructorQuestionAnswersDataTable $instructorquestionanswers)
            {
               return $instructorquestionanswers->render('admin.instructorquestionanswers.index',['title'=>trans('admin.instructorquestionanswers')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            // public function create()
            // {
            //    return view('admin.instructorquestionanswers.create',['title'=>trans('admin.create')]);
            // }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            // public function store()
            // {
            //   $rules = [
            //  'question_id'=>'required|numeric',
            //  'answer_id'=>'required|numeric',
            //  'instructor_id'=>'required|numeric',

            //        ];
            //   $data = $this->validate(request(),$rules,[],[
            //  'question_id'=>trans('admin.question_id'),
            //  'answer_id'=>trans('admin.answer_id'),
            //  'instructor_id'=>trans('admin.instructor_id'),

            //   ]);
		
            //   $data['admin_id'] = admin()->user()->id; 
            //   InstructorQuestionAnswer::create($data); 

            //   session()->flash('success',trans('admin.added'));
            //   return redirect(aurl('instructorquestionanswers'));
            // }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $instructorquestionanswers =  InstructorQuestionAnswer::find($id);
                return view('admin.instructorquestionanswers.show',['title'=>trans('admin.show'),'instructorquestionanswers'=>$instructorquestionanswers]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            // public function edit($id)
            // {
            //     $instructorquestionanswers =  InstructorQuestionAnswer::find($id);
            //     return view('admin.instructorquestionanswers.edit',['title'=>trans('admin.edit'),'instructorquestionanswers'=>$instructorquestionanswers]);
            // }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            // public function update($id)
            // {
            //     $rules = [
            //  'question_id'=>'required|numeric',
            //  'answer_id'=>'required|numeric',
            //  'instructor_id'=>'required|numeric',

            //              ];
            //  $data = $this->validate(request(),$rules,[],[
            //  'question_id'=>trans('admin.question_id'),
            //  'answer_id'=>trans('admin.answer_id'),
            //  'instructor_id'=>trans('admin.instructor_id'),
            //        ]);
            //   $data['admin_id'] = admin()->user()->id; 
            //   InstructorQuestionAnswer::where('id',$id)->update($data);

            //   session()->flash('success',trans('admin.updated'));
            //   return redirect(aurl('instructorquestionanswers'));
            // }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $instructorquestionanswers = InstructorQuestionAnswer::find($id);


               @$instructorquestionanswers->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
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
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $instructorquestionanswers = InstructorQuestionAnswer::find($data);
 

                    @$instructorquestionanswers->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }

            
}