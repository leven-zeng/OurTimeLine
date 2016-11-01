<?php

namespace App\Http\Controllers\Admin;


use App\Model\images;
use App\Model\test;
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
       // $image=new images();
        //dd($image::all());
        return view('Admin/indextest');
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
            $imgs=$request->get('imagenames');
            if(strlen($imgs)>0) {
                $img = explode(",", $imgs);
                foreach($img as $str){
                    $image=new images();
                    $image->timerId=$timer->id;
                    $image->imgName=$str;
                    $image->save();
                }
            }
            return 'success';
        }else{
            return '保存失败';
        }
    }

    public function ImgTest(){
        return view("Admin/ImgTest");
    }

    //上传图片的服务端
    public function UploadImg(Request $request){
//        \Debugbar::disable();
        $uploaddir = 'images/uploads/';

        $uploadfile = md5(uniqid()).substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.'));


        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.$uploadfile)) {
            //print "File is valid, and was successfully uploaded.  Here's some more debugging info:\n";
            return($uploadfile);
        } else {
            print "图片上传失败！";
            print_r($_FILES);
        }
    }
}
