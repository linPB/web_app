<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Dashboard 3</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="/assist/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/assist/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="sidebar-mini control-sidebar-slide-open text-sm sidebar-collapse">

<div class="wrapper">
<!-- Navbar -->
@include('layout.navbar')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('layout.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <iframe name="mainiframe" id="mainiframe" width="100%"  src="/admin/index/home"
            frameborder="0" marginwidth="0" marginheight="0" scrolling="auto"
            onload="changeFrameHeight()"
    ></iframe>

    <div class="" style="opacity: 0"><canvas id="visitors-chart" height="0"></canvas></div>
    <div class="" style="opacity: 0"><canvas id="sales-chart" height="0"></canvas></div>
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
{{--@include('layout.c_sidebar')--}}
<!-- /.control-sidebar -->

<!-- Main Footer -->
@include('layout.footer')
</div>

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/adminlte/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
<script src="/adminlte/dist/js/demo.js"></script>
<script src="/adminlte/dist/js/pages/dashboard3.js"></script>

<script>

    $('.nav-item li').click(function(){
        // 移除点击的li以外的li的active class
        var obj = $(this).siblings().removeClass('active');
        // 给点击的li添加active class
        var obj = $(this).addClass('active');
    });

    function changeFrameHeight(){
        var ifm= document.getElementById("mainiframe");
        ifm.height=document.documentElement.clientHeight -107;
    }
    window.onresize=function(){
        var ua = navigator.userAgent.toLowerCase();

        var screenwidth = window.screen.width;
        // console.log("屏幕宽度为", screenwidth);
        if (!/iphone|ipad|ipod/.test(ua)) {
        } else {
            document.getElementById("mainiframe").width = screenwidth;
        }
        changeFrameHeight();
    };
</script>
</body>
</html>
