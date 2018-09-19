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
    <div class="mdui-card index-content-card mdui-m-y-2">
        {{--头条 此部分内容可后台自定义--}}
        @include('index.topnews')
        <div class="mdui-row">
            <div class="mdui-col-md-6 mdui-col-xs-12">
                {{--资讯 此部分内容分版块数据库拉取--}}
                @include('index.info')
            </div>
            <div class="mdui-col-md-6 mdui-col-xs-12">
                @include('index.topic')
            </div>
        </div>
        <div class="mdui-row">
            <div class="mdui-col-md-6 mdui-col-xs-12">
                {{--资讯 此部分内容分版块数据库拉取--}}
                @include('index.flea-market')
            </div>
            <div class="mdui-col-md-6 mdui-col-xs-12">
                @include('index.schools')
            </div>
        </div>
    </div>
    <div class="mdui-card index-content-card mdui-m-y-2">
        @include('index.community')
    </div>
    <a href="{{route('communityTopicCreate')}}" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}" class="mdui-fab mdui-fab-fixed mdui-color-pink-accent">
        <i class="mdui-icon material-icons">add</i>
    </a>
@endsection