@extends('frame.indexframe')
@section('title',$user->name)
@section('subtitleUrl',route('showPersonalCenter',$user->id))
@if($userIsMe)
    @section('tabActiveVal','me-tab')
    @section('bottomNavActiveVal','me-bottom-nav')
@else
    @section('tabActiveVal','community-tab')
    @section('bottomNavActiveVal','community-bottom-nav')
@endif

@section('content')
    {{--个人页头部封面--}}
    @include('personal-center.cover')
    <div class="mdui-row">
        <div class="mdui-col-md-9 mdui-col-xs-12">
            @include('personal-center.left')
        </div>
        <div class="mdui-col-md-3 mdui-hidden-sm-down">
            @include('personal-center.focus-right')
            @include('personal-center.info-right')
        </div>
    </div>
    @if($userIsMe)
        {{--用户信息修改--}}
        @include('personal-center.edit-user-info')
    @endif

    {{--查看关注人对话框--}}
    @include('personal-center.follow-dialog')
    {{--此个人页的用户ID--}}
    <input class="mdui-hidden" name="userId" value="{{$user->id}}"/>
    <input class="mdui-hidden" name="userIsMe" value="{{$userIsMe}}"/>
    {{--Js所需翻译库--}}
    <input class="mdui-hidden" name="__follow" value="{{__('user.follow')}}"/>
    <input class="mdui-hidden" name="__followed" value="{{__('user.followed')}}"/>
    <input class="mdui-hidden" name="__closeHelpEditTitle" value="{{__('user.closeHelpEditTitle')}}"/>
    <input class="mdui-hidden" name="__closeHelpEditContent" value="{{__('user.closeHelpEditContent')}}"/>
@endsection