@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        {{--<div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px; ">--}}
        <div class="mdui-col-md-12 mdui-col-xs-12" style="padding-top: 20px; ">
            <div class="mdui-card content-card">
                {{--一级分区列表--}}
                @include('community.left-zones-list')
                {{--详细二级版块分类列表--}}
                @include('community.left-sections-list')
            </div>


        </div>
        {{--<div class="mdui-col-md-3 mdui-col-xs-12" style="padding-top: 20px; ">--}}
            {{--侧边栏--}}
        {{--</div>--}}
    </div>
    <div class="mdui-fab-wrapper" mdui-fab="{trigger: 'click'}">
        <button class="mdui-fab mdui-ripple mdui-color-pink-accent">
            <!-- 默认显示的图标 -->
            <i class="mdui-icon material-icons">add</i>
            <!-- 在拨号菜单开始打开时，平滑切换到该图标，若不需要切换图标，则可以省略该元素 -->
            <i class="mdui-icon mdui-fab-opened material-icons">favorite</i>
        </button>
        <div class="mdui-fab-dial">
            <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-blue mdui-text-color-white" mdui-tooltip="{content: '{{__('message.newMessages')}}', position: 'left'}"><i class="mdui-icon material-icons">message</i></button>
            <a href="{{route('communityTopicCreate')}}" class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-pink-accent" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}"><i class="mdui-icon material-icons">bubble_chart</i></a>
        </div>
    </div>
@endsection