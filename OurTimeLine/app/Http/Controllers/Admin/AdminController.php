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

    public function ImgTest(){
        return view("Admin\ImgTest");
    }

    //上传图片的服务端
    public function UploadImg(Request $request){
        $uploaddir = 'Images/uploads/';

        $uploadfile = $uploaddir. md5(uniqid()).substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.'));



        print "<pre>";
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            print "File is valid, and was successfully uploaded.  Here's some more debugging info:\n";
            print_r($_FILES);
        } else {
            print "Possible file upload attack!  Here's some debugging info:\n";
            print_r($_FILES);
        }
        print "</pre>";
    }
}
