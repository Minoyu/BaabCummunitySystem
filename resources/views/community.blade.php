@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-9 mdui-col-xs-12">
            {{--一级分区列表--}}
            @include('community.left-zones-list')
            {{--详细二级版块分类列表--}}
            @include('community.left-sections-list')
        </div>
        <div class="mdui-col-md-3 mdui-hidden-sm">
            侧边栏
        </div>
    </div>
@endsection