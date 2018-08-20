@extends('frame.indexframe')
@section('title',__('index.discover'))
@section('subtitleUrl',route('showDiscover'))
@section('tabActiveVal','discover-tab')
@section('bottomNavActiveVal','discover-bottom-nav')

@section('content')
    <div class="mdui-row">
        @include('discover-search-res.search')
        {{--内容块--}}
        <div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px">
            @include('discover-search-res.left-list')
        </div>
        {{--侧边栏，小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-hidden-sm-down" style="padding-top: 20px">
            侧边栏
        </div>
    </div>
    <input class="mdui-hidden" name="__follow" value="关注"/>
    <input class="mdui-hidden" name="__followed" value="已关注"/>
@endsection