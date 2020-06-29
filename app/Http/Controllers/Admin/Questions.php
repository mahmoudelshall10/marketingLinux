<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\QuestionsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Question;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class Questions extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(QuestionsDataTable $questions)
            {
               return $questions->render('admin.questions.index',['title'=>trans('admin.questions')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.questions.create',['title'=>trans('admin.create')]);
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
             'question_ar'=>'required|string',
             'question_en'=>'required|string',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'question_ar'=>trans('admin.question_ar'),
             'question_en'=>trans('admin.question_en'),

              ]);
		
              $data['admin_id'] = admin()->user()->id; 
              Question::create($data); 

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('questions'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $questions =  Question::find($id);
                return view('admin.questions.show',['title'=>trans('admin.show'),'questions'=>$questions]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $questions =  Question::find($id);
                return view('admin.questions.edit',['title'=>trans('admin.edit'),'questions'=>$questions]);
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
             'question_ar'=>'required|string',
             'question_en'=>'required|string',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'question_ar'=>trans('admin.question_ar'),
             'question_en'=>trans('admin.question_en'),
                   ]);
              $data['admin_id'] = admin()->user()->id; 
              Question::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('questions'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $questions = Question::find($id);


               @$questions->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$questions = Question::find($id);

                    	@$questions->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $questions = Question::find($data);
 

                    @$questions->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }

            
}