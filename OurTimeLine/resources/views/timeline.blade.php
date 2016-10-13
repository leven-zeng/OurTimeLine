<!DOCTYPE html>
<!--[if IE 7]><html class="ie7" lang="zh"><![endif]-->
<!--[if gt IE 7]><!-->
<html lang="zh">
<!--<![endif]-->
<head>
        <!--  <base href="<%=basePath%>"> -->
        <title>爱的路上</title>
        <meta http-equiv="Content-Type"content="text/html;charset=utf-8"/>
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="keywords" content="lyqiangmny,lyqiang,爱的路上">
        <meta http-equiv="description" content="爱的路上">
        <link rel="shortcut icon" href="images/favicon-1.ico" type="image/x-icon" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/comm.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/zoomimage.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/custom.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/eye.js"></script>
        <script type="text/javascript" src="js/utils.js"></script>
        <script type="text/javascript" src="js/zoomimage.js"></script>
        <script type="text/javascript" src="js/layout.js"></script>

</head>
<body>

<div class="content">
        <div class="wrapper">
                <div class="light"><i></i></div>
                <hr class="line-left">
                <hr class="line-right">
                <div class="main">
                        <h1 class="title" id="ourTime">我们的时光</h1>

                        ﻿@foreach($years as $year)

                        <div class="year">
                                <h2 class="year_"><a href="#">{{$year->year}}<i></i></a></h2>
                                <div class="list">
                                        <ul>
                                                <?php $timesdata=$timers->where('year',$year->year);
                                                $i=0;
                                                ?>
                                                @foreach($timesdata as $time)
                                                        <?php $i++; ?>
                                                        {{$i}}
                                                <li class="cls <?php if($i % 2==0) echo 'highlight' ?> ">
                                                        <p class="date">
                                                                {{$time->date}}<br/>
                                                                <span class="silverstyle">{{$time->address}}</span><br/>
                                                                <span class="silverstyle">{{$time->authorId}}</span>
                                                        </p>
                                                        <p class="intro">
                                                                {{$time->title}}<div class="more" style="font-size: 12px;">
                                                                <div style="padding: 4px 0 10px 0;">{{$time->content}}</div>
                                                                <div>

                                                                </div>
                                                        </div>
                                                        </p>
                                                </li>

                                                        @endforeach

                                        </ul>
                                </div>
                        </div>

                                 @endforeach

                </div>

        </div>
</div>
</div>

<div id="elevator_item">
        <a id="elevator" onclick="return false;" title="回到顶部"></a>
        <a class="qr"></a>
        <div class="qr-popup">
                <a class="code-link"><img class="code" width="150" height="150" src="images/wx.jpg"/></a>
                <span>幸福永远</span>
                <div class="arr"></div>
        </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
        $(".main .year .list").each(function (e, target) {
                var $target=  $(target),
                        $ul = $target.find("ul");
                $target.height($ul.outerHeight()), $ul.css("position", "absolute");
        });
        $(".main .year>h2>a").click(function (e) {
                e.preventDefault();
                $(this).parents(".year").toggleClass("close");
        });

        $(function() {
                $(window).scroll(function(){
                        var scrolltop=$(this).scrollTop();
                        if(scrolltop>=200){
                                $("#elevator_item").show();
                        }else{
                                $("#elevator_item").hide();
                        }
                });
                $("#elevator").click(function(){
                        $("html,body").animate({scrollTop: 0}, 500);
                });
                $(".qr").hover(function(){
                        $(".qr-popup").show();
                },function(){
                        $(".qr-popup").hide();
                });

                $(".qr").click(
                        function (){
                                top.window.location ='view/login.php';
                        }
                );



        });
</script>
</body>
</html>