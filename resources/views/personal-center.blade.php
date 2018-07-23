@extends('frame.indexframe')
@section('title',$user)
@section('subtitleUrl',route('showPersonalCenter',$user))
@section('tabActiveVal','me-tab')
@section('bottomNavActiveVal','me-bottom-nav')

@section('content')
    {{--个人页头部封面--}}
    @include('personal-center.cover')
    <div class="mdui-row">
        <div class="mdui-col-md-9 mdui-col-xs-12">
            @include('personal-center.left')
        </div>
        <div class="mdui-col-md-3 mdui-hidden-sm-down">
            侧边栏
        </div>
    </div>
@endsection