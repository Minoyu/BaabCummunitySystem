@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-9 mdui-col-xs-12">
            @include('community-sec.zones-header')
            @include('community-sec.sections-list')
        </div>
        <div class="mdui-col-md-3 mdui-hidden-sm-down">
            侧边栏
        </div>
    </div>
@endsection