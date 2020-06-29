<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AnswersDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Answer;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class Answers extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(AnswersDataTable $answers)
            {
               return $answers->render('admin.answers.index',['title'=>trans('admin.answers')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.answers.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store()
            {
              $rules = [
             'answer_ar'=>'required|string',
             'answer_en'=>'required|string',
             'question_id'=>'required|numeric',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'answer_ar'=>trans('admin.answer_ar'),
             'answer_en'=>trans('admin.answer_en'),
             'question_id'=>trans('admin.question_id'),

              ]);
		
              $data['admin_id'] = admin()->user()->id; 
              Answer::create($data); 

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('answers'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $answers =  Answer::find($id);
                return view('admin.answers.show',['title'=>trans('admin.show'),'answers'=>$answers]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $answers =  Answer::find($id);
                return view('admin.answers.edit',['title'=>trans('admin.edit'),'answers'=>$answers]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [
             'answer_ar'=>'required|string',
             'answer_en'=>'required|string',
             'question_id'=>'required|numeric',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'answer_ar'=>trans('admin.answer_ar'),
             'answer_en'=>trans('admin.answer_en'),
             'question_id'=>trans('admin.question_id'),
                   ]);
              $data['admin_id'] = admin()->user()->id; 
              Answer::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('answers'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $answers = Answer::find($id);


               @$answers->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$answers = Answer::find($id);

                    	@$answers->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $answers = Answer::find($data);
 

                    @$answers->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }

            
}