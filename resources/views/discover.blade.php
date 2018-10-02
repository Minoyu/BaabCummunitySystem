@extends('frame.indexframe')
@section('title',__('index.discover'))
@section('subtitleUrl',route('showDiscover'))
@section('tabActiveVal','discover-tab')
@section('bottomNavActiveVal','discover-bottom-nav')

@section('content')
    <div class="mdui-row">
        @include('discover.search')
        {{--内容块--}}
        <div class="mdui-col-md-12 mdui-col-xs-12" style="padding-top: 20px">
        {{--<div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px">--}}
            @include('discover.left-list')
        </div>
        {{--侧边栏，小屏隐藏--}}
        {{--<div class="mdui-col-md-3 mdui-hidden-sm-down" style="padding-top: 20px">--}}
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