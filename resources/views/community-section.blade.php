@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        {{--<div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px; ">--}}
        <div class="mdui-col-md-12 mdui-col-xs-12" style="padding-top: 20px; ">
            <div class="mdui-card content-card community-section-content">
                <div class="photo-gallery">
                    <figure>
                        <a href="{{$section->img_url}}" data-size="400x400">
                            <img src="{{$section->img_url}}" class="community-section-top-img mdui-hoverable" />
                        </a>
                        <figcaption class="mdui-hidden">{{$section->name}}</figcaption>
                    </figure>
                </div>
                <div class="community-section-top-txt-area">
                    <div class="community-section-top-name">{{$section->name}}</div>
                    <div class="community-section-top-sub-area">
                        <div class="mdui-chip mdui-m-r-1">
                            <span class="mdui-chip-icon mdui-color-blue"><i class="mdui-icon material-icons">&#xe0bf;</i></span>
                            <span class="mdui-chip-title"><span class="mdui-hidden-xs">{{__('index.postsCount')}} : </span>{{$section->topic_count}}</span>
                        </div>
                    </div>
                    <div class="community-section-top-tip">{{__('community.section')}}</div>
                    <a href="{{route('communityTopicCreate',['zone_id'=>$section->communityZone->id,'section_id'=>$section->id])}}" class="mdui-btn create-topic-btn ">
                        <i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>
                        {{__('community.createTopics')}}
                    </a>
                </div>
                <div class="community-section-top-description">
                    {{$section->description}}
                </div>
                @include('admin.layout.msg')
                @include('community-section.topics-list')
            </div>

        </div>
        {{--<div class="mdui-col-md-3 mdui-hidden-sm-down">--}}
            {{--侧边栏--}}
        {{--</div>--}}
    </div>
    <a href="{{route('communityTopicCreate',['zone_id'=>$section->communityZone->id,'section_id'=>$section->id])}}" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}" class="mdui-fab mdui-fab-fixed mdui-color-pink-accent">
        <i class="mdui-icon material-icons">add</i>
    </a>

@endsection