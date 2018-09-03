@extends('frame.indexframe')
@section('title',__('index.community'))
@section('titleContent',$topic->title.' - ')
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')

@section('content')
    <div class="mdui-row">
        {{--内容块--}}
        <div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px">
            @include('community-content.content')
            @include('community-content.thumb-up')
            @include('community-content.comment')
        </div>
        {{--侧边栏，小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-col-xs-12" style="padding-top: 4px">
            @include('community-content.side-clumn')
        </div>
    </div>
    {{--Js所需翻译库--}}
    <input class="mdui-hidden" name="__follow" value="{{__('user.follow')}}"/>
    <input class="mdui-hidden" name="__followed" value="{{__('user.followed')}}"/>
@endsection