<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class Users extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(UsersDataTable $users)
            {
               return $users->render('admin.users.index',['title'=>trans('admin.users')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $users =  User::find($id);
                return view('admin.users.show',['title'=>trans('admin.show'),'users'=>$users]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
                // public function edit($id)
                // {
                //     $users =  User::find($id);
                //     return view('admin.users.edit',['title'=>trans('admin.edit'),'users'=>$users]);
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
            //  'name'=>'required|string',
            //  'email'=>'required|string',

            //              ];
            //  $data = $this->validate(request(),$rules,[],[
            //  'name'=>trans('admin.name'),
            //  'email'=>trans('admin.email'),
            //        ]);
            //   User::where('id',$id)->update($data);

            //   session()->flash('success',trans('admin.updated'));
            //   return redirect(aurl('users'));
            // }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $users = User::find($id);


               @$users->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$users = User::find($id);

                    	@$users->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $users = User::find($data);
 

                    @$users->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }

            
}