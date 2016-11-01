@extends('layouts.app')
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../layer/layer.js"></script>
<script src="../js/laydate/laydate.js"></script>
<!-- 引用控制层插件样式 -->
<link rel="stylesheet" href="/zyUpload_php/control/css/zyUpload.css" type="text/css">
<style type="text/css">
    #preview{
        box-sizing: content-box !important;
    }
    *, :after, :before{
        box-sizing: content-box !important;
    }
    .upload_append_list{
        height: auto;
    }
    #demo{
        height:auto !important;
    }
</style>

<!--图片弹出层样式 必要样式-->
<script type="text/javascript" src="/zyUpload_php/jquery-1.7.2.js"></script>
<!-- 引用核心层插件 -->
<script type="text/javascript" src="/zyUpload_php/core/zyFile.js"></script>
<!-- 引用控制层插件 -->
<script type="text/javascript" src="/zyUpload_php/control/js/zyUpload.js"></script>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">添加时间轴</div>
                    <div class="panel-body">
                        <form id="form" class="form-horizontal" role="form" method="POST" action="{{ url('admin/addtimeline') }}">

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">地点</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">主题</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">内容</label>

                                <div class="col-md-6">
                                    <input id="" type="text" class="form-control" name="content" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">日期</label>

                                <div class="col-md-4">
                                    <input id="datetime" type="text" class="form-control" name="datetime" value="" required autofocus>
                                </div>
                            </div>

                            <div id="demo" class="demo"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" id="imagenames" val="" >
                                    <button type="button" class="btn btn-primary" onclick="postData()">
                                        提交
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        ;!function(){
            laydate.skin('molv');
            laydate({
                elem: '#datetime',
            })
        }();

        $(function(){
            // 初始化插件
            $("#demo").zyUpload({
                width            :   "650px",                 // 宽度
                height           :   "400px",                 // 宽度
                itemWidth        :   "120px",                 // 文件项的宽度
                itemHeight       :   "100px",                 // 文件项的高度
                //url              :   "/upload/UploadAction",  // 上传文件的路径
                url              :   "{{url("admin/uploadimg")}}?_token="+$("input[name='_token']").val(),
                multiple         :   true,                    // 是否可以多个文件上传
                dragDrop         :   true,                    // 是否可以拖动上传文件
                del              :   true,                    // 是否可以删除文件
                finishDel        :   false,  				  // 是否在上传文件完成后删除预览
                /* 外部获得的回调接口 */
                onSelect: function(selectFiles, allFiles){    // 选择文件的回调方法  selectFile:当前选中的文件  allFiles:还没上传的全部文件
                    if(allFiles.length>3){
                        layer.msg('最多允许上传三张图片',function(){});
                        debugger;
                        var num=allFiles.length-3;
                        $(".upload_append_list:lt("+num+")").remove();
                        allFiles.splice(0,num);
                        return false;
                    }
                    //console.info("当前选择了以下文件：");
                    //console.info(selectFiles);
                },
                onProgress: function(file, loaded, total){    // 正在上传的进度的回调方法
                   // console.info("当前正在上传此文件：");
                   //console.info(file.name);
                   //console.info("进度等信息如下：");
                   //console.info(loaded);
                   //console.info(total);
                },
                onDelete: function(file, files){              // 删除一个文件的回调方法 file:当前删除的文件  files:删除之后的文件
                    //console.info("当前删除了此文件：");
                    //console.info(file.name);
                },
                onSuccess: function(file, response){          // 文件上传成功的回调方法
                    //console.info("此文件上传成功：");
                    //console.info(file.name);
                    var imgs= $("#imagenames").val();
                    if(imgs!=""){
                        imgs=imgs+',';
                        $("#imagenames").val(imgs+response);
                    }else {
                        $("#imagenames").val(response);
                    }
                },
                onFailure: function(file, response){          // 文件上传失败的回调方法
                    //console.info("此文件上传失败：");
                   // console.info(file.name);
                },
                onComplete: function(response){           	  // 上传完成的回调方法
                    //console.info("文件上传完成");
                    //console.info(response);
                }
            });

        });

        function postData(){
            $("#form input").each(function(){
                if($(this).val().trim()=='') {
                    layer.msg('请先填写完整的信息！',function(){});
                    return false;
                }
            });
            var params={address:$("#address").val(),title:$("#title").val(),content:$("input[name='content']").val(),datetime:$("#datetime").val(),imagenames:$("#imagenames").val(),_token:$("input[name='_token']").val()};
            $.ajax({
                url:'{{url('admin/addtimeline')}}',
                type:'post',
                dateType:'json',
                data:params,
                success:function(data){
                    if(data=="success"){
//                    layer.msg('已经写入到您的时间轴了哦！');
                        layer.msg('已经写入到您的时间轴了哦，现在去看看？', {
                            time: 0 //不自动关闭
                            ,area: ['320px', '120px']
                            ,btn: ['必须啊', '待会看']
                            ,yes: function(index){
                                layer.close(index);
                                window.open("{{url("/")}}");
                            },btn2:function(index){
                                layer.close(index);
                                window.location=window.location;
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
