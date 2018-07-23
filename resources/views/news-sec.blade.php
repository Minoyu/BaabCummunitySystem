@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')
    <div class="mdui-row">
        {{--二级新闻页主列表--}}
        <div class="mdui-col-md-9 mdui-col-xs-12">
            @include('news-sec.lists')
        </div>
        {{--侧边栏，板块切换,小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-hidden-sm-down">
            @include('news-sec.side-clumn')
        </div>
    </div>
@endsection