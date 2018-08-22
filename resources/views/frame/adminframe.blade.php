{{--管理后台框架 区域：title content--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="isLogged" content="{{ Auth::check() }}">

    <title>{{ env('APP_NAME','留学生网站') }}管理后台 - @yield('title')</title>

    <!-- Styles -->
    <link href="/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/css/swiper-4.3.5.min.css" rel="stylesheet" type="text/css">
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="/css/animate.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.bootcss.com/ionicons/4.1.2/css/ionicons.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/admin.css" rel="stylesheet" type="text/css">
</head>
<body class="mdui-appbar-with-toolbar mdui-drawer-body-left">
    {{--顶栏--}}
    @include('admin.layout.appbar')

    <div class="mdui-container">
        {{--主体部分--}}
        @yield('content')
    </div>
    {{--侧边栏--}}
    @include('admin.layout.drawer')

    {{--激活导航栏值--}}
    <div id="adminDrawerActiveVal" class="mdui-hidden">@yield('adminDrawerActiveVal')</div>
    <!-- Js -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.slim.min.js"></script>
    <script src="/layui/layui.js"></script>
    <script src="/js/swiper-4.3.5.min.js"></script>
    <script src="/js/mdui.min.js"></script>
    <script src="/js/wangEditor.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/admin.js"></script>
</body>
</html>