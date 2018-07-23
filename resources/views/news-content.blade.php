@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')
    {{--内容块--}}
    <div class="mdui-col-md-9 mdui-col-xs-12">
        @include('news-content.content')
        @include('news-content.comment-list')
        @include('news-content.content-area')
    </div>
    {{--侧边栏，小屏隐藏--}}
    <div class="mdui-col-md-3 mdui-hidden-sm-down">
        @include('news-content.side-clumn')
    </div>
@endsection