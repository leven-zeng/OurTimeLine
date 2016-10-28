<?php

namespace App\Http\Controllers;

use App\Model\images;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Timers;
use Illuminate\Support\Facades\DB;

class TimeLineController extends Controller
{
    //
    public function index(){
        //$timers=  Timers::orderBy('date','desc')->get();
        $timers=  Timers::select('*')->orderBy('date','desc')->get();

        $years=  Timers::select('year')->groupBy('year')->orderBy('year','desc') ->get();

        //$data=DB::table('timers')->leftjoin('images',function($join){
        //    $join->on('timers.id','=','images.timerId');
        //})->select('timers.*','images.imgName')->where('images.status','=',0)->get();
        //

        return view('timeline')->with(array('timers'=>$timers,'years'=>$years));
    }
}
