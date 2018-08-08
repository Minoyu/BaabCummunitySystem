@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')
    <div class="mdui-row">
        {{--内容块--}}
        <div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px">
            @if($news->cover_img)
                @include('news-content.content-with-img')
            @else
                @include('news-content.content-without-img')
            @endif

            @include('news-content.comment')
        </div>
        {{--侧边栏，小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-hidden-sm-down" style="padding-top: 20px">
            @include('news-content.side-clumn')
        </div>
    </div>
@endsection