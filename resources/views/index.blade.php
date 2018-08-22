@extends('frame.indexframe')
@section('title',__('index.home'))
@section('subtitleUrl',route('showIndex'))
@section('tabActiveVal','home-tab')
@section('bottomNavActiveVal','home-bottom-nav')
@section('content')
    {{--新闻部分 分栏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-8 mdui-col-xs-12 index-carousel">
            {{--轮播图--}}
            @include('index.carousel')
        </div>
        <div class="mdui-col-md-4 mdui-col-xs-12">
            {{--PC轮播图右侧 移动端轮播图下方--}}
            @include('index.carousel-right')
        </div>
    </div>
    <div class="mdui-card content-card mdui-m-y-2">
        {{--头条 此部分内容可后台自定义--}}
        @include('index.topnews')
        <div class="mdui-row">
            <div class="mdui-col-md-6 mdui-col-xs-12">
                {{--资讯 此部分内容分板块数据库拉取--}}
                @include('index.info')
            </div>
            <div class="mdui-col-md-6 mdui-col-xs-12">
                @include('index.regional')
            </div>
        </div>
        @include('index.community')
    </div>

@endsection