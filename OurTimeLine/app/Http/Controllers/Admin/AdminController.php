<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



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
}
