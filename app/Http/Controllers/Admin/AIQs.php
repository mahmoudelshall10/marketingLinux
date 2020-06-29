<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AIQsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\AIQ;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class AIQs extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(AIQsDataTable $aiqs)
            {
               return $aiqs->render('admin.aiqs.index',['title'=>trans('admin.aiqs')]);
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

            public function show($id)
            {
                $aiqs =  AIQ::find($id);
                return view('admin.aiqs.show',['title'=>trans('admin.show'),'aiqs'=>$aiqs]);
            }
            
}