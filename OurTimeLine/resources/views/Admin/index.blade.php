<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2016/9/30
 * Time: 14:28
 */

        ?>

@extends('layouts.app')


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
    </style>
    <script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="../layer/layer.js"></script>
    <script src="../js/laydate/laydate.js"></script>



    <div id="form" class="row">
        <p><label>地点：</label><input id="adress" name="adress" type="text"></p>
        <p><label>主题：</label><input id="title" name="title" type="text"></p>
        <p><label>内容：</label><input id="content" name="content" type="text"></p>
        <p><label>时间：</label><input id="datetime" name="datetime" type="datetime" class="laydate-icon"></p>

        <p><button type="button" class="btn btn-dark" id="submit" onclick="postData()">提&nbsp;&nbsp;&nbsp;&nbsp;交</button></p>
    </div>
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
            var params={adress:$("#adress").val(),title:$("#title").val(),content:$("#content").val(),datetime:$("#datetime").val()};
            $.ajax({
                url:'../bean/addTimerec.php',
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