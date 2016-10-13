<?php

namespace App\Http\Controllers\Admin;

use App\Model\Timers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    //
    public function index(){
        //dd('123');
        return view('Admin\index');
    }


    public function AddTimeLine(Request $request){
        //dd(date("Y",strtotime($request->get('datetime'))));
        $timer=new Timers();
        $timer->year=date("Y",strtotime($request->get('datetime')));
        $timer->date=$request->get('datetime');
        $timer->address=$request->get('address');
        $timer->title=$request->get('title');
        $timer->content=$request->get('content');
        $timer->authorId=Auth::user()->id;
        if($timer->save()){
            return 'success';
        }else{
            return '保存失败';
        }
    }
}
