{{--主页类型的框架 包含顶部应用栏 侧边栏 PC顶部tab选项卡 手机底部选项卡 区域：title content--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME','留学生网站') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/element-ui/lib/theme-chalk/index.css" rel="stylesheet" >
    <link href="/css/main.css" rel="stylesheet" type="text/css">
</head>
<body class="mdui-drawer-body-left body-padding mdui-bottom-nav-fixed mdui-theme-primary-blue">
    {{--顶部应用栏--}}
    @include('layout.appbar')
    {{--侧边抽屉导航--}}
    @include('layout.index-drawer')
    {{--底部导航栏--}}
    @include('layout.bottom-nav')

    {{--主体部分--}}
    @yield('content')

    1.test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    test<br>
    lasttest<br>
    <!-- Js -->
    <script src="/js/mdui.min.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>