@extends('frame.adminframe')
@section('title',__('admin.communityTopicsManage'))
@section('subtitleUrl',route('adminCommunityTopicListByCategory'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin.findTopicsBySections')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminCommunityTopicCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn">
        <i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createTopics')}}
    </a>
    <a href="{{route('adminCommunityZonesAndSectionsShow')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal admin-btn none-text-transform-btn">
        <i class="mdui-icon material-icons mdui-icon-left">format_list_bulleted</i>{{__('admin.manage')}}{{__('community.zonesAndSections')}}</a>
        <ul class="mdui-list mdui-color-white mdui-card mdui-hoverable" id="adminCommunityCategoryCollapse" style="border-radius: 5px" >
                @foreach($zones as $zone)
                    <li class="mdui-collapse-item">
                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                            <div class="mdui-list-item-avatar"><img src="{{$zone->img_url}}"/></div>
                            <div class="mdui-list-item-content">
                                @if($zone->status=='hidden')
                                    <span class="mdui-text-color-pink">
                                    <i class="mdui-icon material-icons">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                                    </span>
                                @endif
                                {{$zone->name}}
                                <div class="mdui-chip">
                                    <span class="mdui-chip-title">{!!__('layout.topicsCountTip',['num'=>$zone->topic_count])!!}</span>
                                </div>
                            </div>
                            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                        </div>
                        <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                            @if(count($zone->communitySections))
                                @foreach( $zone->communitySections as $section)
                                    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                        {{--<i class="mdui-list-item-icon mdui-icon material-icons">{{$child["icon"]}}</i>--}}
                                        <div class="mdui-list-item-avatar"><img src="{{$section->img_url}}"/></div>
                                        <div class="mdui-list-item-content">
                                            @if($section->status=='hidden')
                                                <span class="mdui-text-color-pink">
                                                    <i class="mdui-icon material-icons">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                                                </span>
                                            @endif {{$section->name}}
                                        </div>
                                        <a href="{{route('adminCommunityTopicList',["section_id"=>$section->id])}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1 none-text-transform-btn">
                                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>{!!__('layout.viewTopicsCountTip',['num'=>$section->topic_count]) !!}
                                        </a>
                                        <a href="{{route('adminCommunityTopicCreate',["zone_id"=>$zone->id,"section_id"=>$section->id])}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-color-blue-accent mdui-m-r-1">
                                            <i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createTopics')}}
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple mdui-text-color-grey">
                                    <i class="mdui-list-item-icon mdui-icon material-icons">block</i>
                                    <div class="mdui-list-item-content"> {{__('admin/community.noSectionsUnder')}}</div>
                                </div>
                            @endif
                        </ul>
                    </li>
                @endforeach
        </ul>

        <button onclick="adminCommunityCatOpenAll()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent adminBtn mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">view_list</i>{{__('admin.expendAll')}}</button>
        <button onclick="adminCommunityCatCloseAll()" class="mdui-btn mdui-btn-raised mdui-ripple adminBtn mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">clear</i>{{__('admin.collapse')}}</button>

        <!--/内容-->
@endsection

