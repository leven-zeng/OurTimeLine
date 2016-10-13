<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Timers;

class TimeLineController extends Controller
{
    //
    public function index(){
        $timers=  Timers::All();
        $years=  Timers::select('year')->groupBy('year')->orderBy('year','desc') ->get();

        return view('timeline')->with(array('timers'=>$timers,'years'=>$years));
    }
}
