{{--主页类型的框架 包含顶部应用栏 侧边栏 PC顶部tab选项卡 手机底部选项卡 区域：title content--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="isLogged" content="{{ Auth::check() }}">
    <title>@yield('titleContent')@yield('title') - {{__('index.app_name')}}</title>

    <!-- Styles -->
    <link href="/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/css/swiper-4.3.5.min.css" rel="stylesheet" type="text/css">
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="/css/animate.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.bootcss.com/ionicons/4.1.2/css/ionicons.min.css" rel="stylesheet">
    <link href="/css/main_2018090706.css" rel="stylesheet" type="text/css">
</head>
<body class=" @if($isDrawerOpen) mdui-drawer-body-left @endif body-padding mdui-bottom-nav-fixed mdui-theme-primary-blue">

    <div class="mdui-container">
        {{--主体部分--}}
        @yield('content')
    </div>
    {{--顶部应用栏--}}
    @include('layout.appbar')
    {{--侧边抽屉导航--}}
    @include('layout.drawer')

    {{--底部导航栏--}}
    @include('layout.bottom-nav')
    {{--注册登录重置模块--}}
    @include('layout.login')
    @include('layout.register')
    @include('layout.reset')

    {{--激活导航栏值--}}
    <div id="tabActiveVal" class="mdui-hidden">@yield('tabActiveVal')</div>
    <div id="bottomNavActiveVal" class="mdui-hidden">@yield('bottomNavActiveVal')</div>

    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <!-- Js -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.slim.min.js"></script>
    <script src="/layui/layui.js"></script>
    <script src="/js/swiper-4.3.5.min.js"></script>
    <script src="/js/mdui.min.js"></script>
    <script src="/js/wangEditor.min.js"></script>
    <script src="/js/main_2018090702.js"></script>
</body>
</html>