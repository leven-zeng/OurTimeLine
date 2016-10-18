<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2016/9/30
 * Time: 14:28
 */

?>

@extends('layouts.app')
<link rel="stylesheet" href="/zyUpload_php/control/css/zyUpload.css" type="text/css">

<!--图片弹出层样式 必要样式-->
<script type="text/javascript" src="/zyUpload_php/jquery-1.7.2.js"></script>
<!-- 引用核心层插件 -->
<script type="text/javascript" src="/zyUpload_php/core/zyFile.js"></script>
<!-- 引用控制层插件 -->
<script type="text/javascript" src="/zyUpload_php/control/js/zyUpload.js"></script>

@section('content')
    <style type="text/css">
        body{background-color:#95969C }
        .row label{color:#FFFFFF;  font-size: 16px;}
        .row{margin: 120px auto;text-align: center;width;400px;padding-right:5px;width: 400px }
        .row input{width: 240px;
            height: 32px;
            padding-left: 8px;
            padding-top: 4px;
            padding-bottom: 4px;
            border: solid 1px #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -khtml-border-radius: 5px;
            border-radius: 5px;
            color: #666;
            font: normal 14px Arial, Helvetica, sans-serif;}
        #datetime{width: 220px;}
        .btn-dark {
            color: #ffffff;
            background-color: #a8db43;
            border-color: #a8db43;
        }
        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .layui-layer-btn{text-align: center!important;}

        .wraper{ padding: 30px 0;}
        .btn-wraper{ text-align: center;}
        .btn-wraper input{ margin: 0 10px;}
        #file-list{ width: 350px; margin: 20px auto;}
        #file-list li{ margin-bottom: 10px;}
        .file-name{ line-height: 30px;}
        .progress{ height: 4px; font-size: 0; line-height: 4px; background: orange; width: 0;}
        .tip1{text-align: center; font-size:14px; padding-top:10px;}
        .tip2{text-align: center; font-size:12px; padding-top:10px; color:#b00}
        .catalogue{ position: fixed; _position:absolute; _width:200px; left: 0; top: 0; border: 1px solid #ccc;padding: 10px; background: #eee}
        .catalogue a{ line-height: 30px; color: #0c0}
        .catalogue li{ padding: 0; margin: 0; list-style: none;}
    </style>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../layer/layer.js"></script>
    <script src="../js/laydate/laydate.js"></script>



    <div id="form" class="row">
        <p><label>地点：</label><input id="address" name="address" type="text"></p>
        <p><label>主题：</label><input id="title" name="title" type="text"></p>
        <p><label>内容：</label><input id="content" name="content" type="text"></p>
        <p><label>时间：</label><input id="datetime" name="datetime" type="datetime" class="laydate-icon"></p>


        <div id="demo" class="demo"></div>


        <p><button type="button" class="btn btn-dark" id="submit" onclick="postData()">提&nbsp;&nbsp;&nbsp;&nbsp;交</button></p>
    </div>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">



    <script>

        ;!function(){
            //laydate.skin('molv');
            laydate({
                elem: '#datetime'
            })
        }();



        function postData(){
            $("#form input").each(function(){
                if($(this).val().trim()=='') {
                    layer.msg('请先填写完整的信息！',function(){});
                    return false;
                }
            });
            var params={address:$("#address").val(),title:$("#title").val(),content:$("#content").val(),datetime:$("#datetime").val(),_token:$("input[name='_token']").val()};
            $.ajax({
                url:'{{url('admin/addtimeline')}}',
                type:'post',
                dateType:'json',
                data:params,
                success:function(data){
                    if(data=="OK"){
//                    layer.msg('已经写入到您的时间轴了哦！');
                        layer.msg('已经写入到您的时间轴了哦，现在去看看？', {
                            time: 0 //不自动关闭
                            ,area: ['320px', '120px']
                            ,btn: ['必须啊', '待会看']
                            ,yes: function(index){
                                layer.close(index);
                                window.open("../index.php");
                            }
                        });
                    }
                },
                error:function(){

                }

            })
        }
    </script>

@endsection