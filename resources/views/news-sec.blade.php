@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')

    {{--内容部分--}}

    {{--组件可以放在news-sec文件夹下--}}
    {{--测试路由 /news/test--}}

@endsection