@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')

@section('content')
    <div class="mdui-row">
        {{--内容块--}}
        <div class="mdui-col-md-9 mdui-col-xs-12">
            @include('community-content.content')
            @include('community-content.comment-list')
            @include('community-content.comment-area')
        </div>
        {{--侧边栏，小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-hidden-sm-down">
            @include('community-content.side-clumn')
        </div>
    </div>
@endsection