@extends('frame.indexframe')
@section('title',__('index.home'))
@section('content')
    {{--新闻部分 分栏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-8 mdui-col-xs-12 index-carousel">
            {{--轮播图--}}
            @include('index.carousel')
        </div>
        <div class="mdui-col-md-4 mdui-col-xs-12">
            {{--PC轮播图右侧 移动端轮播图下方--}}
            @include('index.carousel-right')
        </div>
    </div>
    @include('index.topnews')
@endsection