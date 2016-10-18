<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2016/10/18
 * Time: 14:29
 */

        ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>上传</title>
    <!-- 引用控制层插件样式 -->
    <link rel="stylesheet" href="/zyUpload_php/control/css/zyUpload.css" type="text/css">

    <!--图片弹出层样式 必要样式-->
    <script type="text/javascript" src="/zyUpload_php/jquery-1.7.2.js"></script>
    <!-- 引用核心层插件 -->
    <script type="text/javascript" src="/zyUpload_php/core/zyFile.js"></script>
    <!-- 引用控制层插件 -->
    <script type="text/javascript" src="/zyUpload_php/control/js/zyUpload.js"></script>
    <!-- 引用初始化JS -->
    <!--   <script type="text/javascript" src="/zyUpload_php/demo.js"></script> -->
  </head>
  <body>
  <h1 style="text-align:center;">zyFile示例</h1>
  <div id="demo" class="demo"></div>
  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  </body>
  <script>

      $(function(){
          // 初始化插件
          $("#demo").zyUpload({
              width            :   "650px",                 // 宽度
              height           :   "400px",                 // 宽度
              itemWidth        :   "120px",                 // 文件项的宽度
              itemHeight       :   "100px",                 // 文件项的高度
              //url              :   "/upload/UploadAction",  // 上传文件的路径
              url              :   "{{url("admin/uploadimg")}}?_token="+$("#_token").val(),
              multiple         :   true,                    // 是否可以多个文件上传
              dragDrop         :   true,                    // 是否可以拖动上传文件
              del              :   true,                    // 是否可以删除文件
              finishDel        :   false,  				  // 是否在上传文件完成后删除预览
              /* 外部获得的回调接口 */
              onSelect: function(selectFiles, allFiles){    // 选择文件的回调方法  selectFile:当前选中的文件  allFiles:还没上传的全部文件
                  console.info("当前选择了以下文件：");
                  console.info(selectFiles);
              },
              onProgress: function(file, loaded, total){    // 正在上传的进度的回调方法
                  console.info("当前正在上传此文件：");
                  console.info(file.name);
                  console.info("进度等信息如下：");
                  console.info(loaded);
                  console.info(total);
              },
              onDelete: function(file, files){              // 删除一个文件的回调方法 file:当前删除的文件  files:删除之后的文件
                  console.info("当前删除了此文件：");
                  console.info(file.name);
              },
              onSuccess: function(file, response){          // 文件上传成功的回调方法
                  console.info("此文件上传成功：");
                  console.info(file.name);
              },
              onFailure: function(file, response){          // 文件上传失败的回调方法
                  console.info("此文件上传失败：");
                  console.info(file.name);
              },
              onComplete: function(response){           	  // 上传完成的回调方法
                  console.info("文件上传完成");
                  console.info(response);
              }
          });

      });


  </script>
  </html>







