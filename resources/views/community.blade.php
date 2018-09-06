@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px; ">
            <div class="mdui-card content-card">
                {{--一级分区列表--}}
                @include('community.left-zones-list')
                {{--详细二级版块分类列表--}}
                @include('community.left-sections-list')
            </div>


        </div>
        <div class="mdui-col-md-3 mdui-col-xs-12" style="padding-top: 20px; ">
            侧边栏
        </div>
    </div>
    <a href="{{route('communityTopicCreate')}}" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}" class="mdui-fab mdui-fab-fixed mdui-color-pink-accent">
        <i class="mdui-icon material-icons">add</i>
    </a>
@endsection