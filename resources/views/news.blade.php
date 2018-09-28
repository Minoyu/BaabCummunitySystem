@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')
    <div class="mdui-row">
        <div class="mdui-col-md-8 mdui-col-xs-12">
            @include('news.carousel')
            @include('news.left-list')
        </div>
        <div class="mdui-col-md-4 mdui-hidden-sm-down">
            @include('news.right-categories')
        </div>
    </div>

    {{--新闻主页--}}
    {{--<div class="mdui-row">--}}
        {{--<div class="mdui-col-md-8 mdui-col-xs-12 index-carousel">--}}
            {{--大图新闻栏--}}
            {{--@include('news.newspage')--}}
        {{--</div>--}}
        {{--<div class="mdui-col-md-4 mdui-col-xs-12">--}}
            {{--新闻列表--}}
            {{--@include('news.newspage-top-right')--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--新闻卡片--}}
    {{--@include('news.newspage-bottom')--}}
    {{----}}
@endsection