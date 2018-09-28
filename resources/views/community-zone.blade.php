@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')
@section('content')
    {{--PC端分两栏 移动端侧边栏隐藏--}}
    <div class="mdui-row">
        <div class="mdui-col-md-12 mdui-col-xs-12" style="padding-top: 20px; ">
        {{--<div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px; ">--}}
            <div class="mdui-card content-card community-zone-content">
                <div class="photo-gallery">
                    <figure>
                        <a href="{{$zone->img_url}}" data-size="400x400">
                            <img src="{{$zone->img_url}}" class="community-zone-top-img mdui-hoverable">
                        </a>
                        <figcaption class="mdui-hidden">{{$zone->name}}</figcaption>
                    </figure>
                </div>
                <div class="community-zone-top-txt-area">
                    <div class="community-zone-top-name">
                        {{$zone->name}}
                    </div>
                    <div class="community-zone-top-sub-area">
                        <div class="mdui-chip mdui-m-r-1">
                            <span class="mdui-chip-icon mdui-color-blue-grey"><i class="mdui-icon material-icons">storage</i></span>
                            <span class="mdui-chip-title"><span class="mdui-hidden-xs">{{__('index.sectionsCount')}} : </span>{{$zone->section_count}}</span>
                        </div>                        <div class="mdui-chip mdui-m-r-1">
                            <span class="mdui-chip-icon mdui-color-blue"><i class="mdui-icon material-icons">&#xe0bf;</i></span>
                            <span class="mdui-chip-title"><span class="mdui-hidden-xs">{{__('index.postsCount')}} : </span>{{$zone->topic_count}}</span>
                        </div>
                    </div>
                    <div class="community-zone-top-tip">{{__('community.zone')}}</div>
                    <a href="{{route('communityTopicCreate',['zone_id'=>$zone->id])}}" class="mdui-btn create-topic-btn">
                        <i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>
                        {{__('community.createTopics')}}
                    </a>

                </div>
                <div class="community-zone-top-description">
                    {{$zone->description}}
                </div>

                @include('community-zone.sections-list')
            </div>

        </div>
        {{--<div class="mdui-col-md-3 mdui-hidden-sm-down">--}}
            {{--侧边栏--}}
        {{--</div>--}}
    </div>
    <a href="{{route('communityTopicCreate',['zone_id'=>$zone->id])}}" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}" class="mdui-fab mdui-fab-fixed mdui-color-pink-accent">
        <i class="mdui-icon material-icons">add</i>
    </a>
@endsection