{{--这是个什么都没有的空框架 区域：title content--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME','留学生网站') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/css/mdui.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.bootcss.com/ionicons/4.1.2/css/ionicons.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
    {{--主体部分--}}
    @yield('content')
    <!-- Js -->
    <script src="/layui/layui.js"></script>
    <script src="/js/mdui.min.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>