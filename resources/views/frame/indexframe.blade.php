{{--主页类型的框架 包含顶部应用栏 侧边栏 PC顶部tab选项卡 手机底部选项卡 区域：title content--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__('index.app_name')}} - @yield('title')</title>

    <!-- Styles -->
    <link href="/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.bootcss.com/ionicons/4.1.2/css/ionicons.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
</head>
<body class="mdui-drawer-body-left body-padding mdui-bottom-nav-fixed mdui-theme-primary-blue">
    {{--顶部应用栏--}}
    @include('layout.appbar')
    {{--侧边抽屉导航--}}
    @include('layout.drawer')

    <div class="mdui-container">
        {{--主体部分--}}
        @yield('content')
    </div>

    {{--底部导航栏--}}
    @include('layout.bottom-nav')

    <!-- Js -->
    <script src="/layui/layui.js"></script>
    <script src="/js/mdui.min.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>