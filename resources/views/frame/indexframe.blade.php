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
    {{--<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=0.9, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>--}}
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <title>@yield('titleContent')@yield('title') - {{__('index.app_name')}}</title>

    <!-- Styles -->
    {{--PhotoSwipe--}}
    <link href="/photoswipe/photoswipe.css" rel="stylesheet">
    <link href="/photoswipe/default-skin/default-skin.css" rel="stylesheet">
    {{--PhotoSwipe End--}}
    <link href="/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/css/swiper-4.3.5.min.css" rel="stylesheet" type="text/css">
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="/css/animate.css" rel="stylesheet" type="text/css">
    <link href="/css/ionicons.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
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
    @if(!Auth::check())
        @include('layout.login')
        @include('layout.registerByEmail')
        {{--@include('layout.registerByPhone')--}}
    @endif
    @include('layout.reset')
    {{--激活导航栏值--}}
    <div id="tabActiveVal" class="mdui-hidden">@yield('tabActiveVal')</div>
    <div id="bottomNavActiveVal" class="mdui-hidden">@yield('bottomNavActiveVal')</div>

    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif
    {{--PhotoSwipe-HTML--}}
    @include('layout.photoswipe-html')
    {{--Messages Dialog--}}
    @include('message.layout.message-create-content-dialog')
    @include('message.layout.message-create-select-user-dialog')
    <!-- Js -->
    {{--PhotoSwipe Js--}}
    <script src="/photoswipe/photoswipe.min.js"></script>
    <script src="/photoswipe/photoswipe-ui-default.min.js"></script>

    <script src="/js/jquery.min.js"></script>
    <script src="/layui/layui.js"></script>
    <script src="/js/swiper-4.3.5.min.js"></script>
    <script src="/js/mdui.min.js"></script>
    <script src="/js/wangEditor.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>