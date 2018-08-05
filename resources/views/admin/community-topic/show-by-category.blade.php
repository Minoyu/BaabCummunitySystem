@extends('frame.adminframe')
@section('title','社区话题管理')
@section('subtitleUrl',route('adminCommunityTopicListByCategory'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">社区话题——按分区及板块检索</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminCommunityZonesAndSectionsShow')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal admin-btn"><i class="mdui-icon material-icons mdui-icon-left">format_list_bulleted</i>分区及话题管理</a>
        <ul class="mdui-list mdui-color-white mdui-card mdui-hoverable" id="adminCommunityCategoryCollapse" style="border-radius: 5px" >
                @foreach($zones as $zone)
                    <li class="mdui-collapse-item">
                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                            <div class="mdui-list-item-avatar"><img src="{{$zone->img_url}}"/></div>
                            <div class="mdui-list-item-content">
                                @if($zone->status=='hidden')
                                    <span class="mdui-text-color-pink">
                                        [<i class="mdui-icon material-icons">local_cafe</i>暂存]
                                    </span>
                                @endif
                                {{$zone->name}}
                                <div class="mdui-chip">
                                    <span class="mdui-chip-title">共{{$zone->topic_count}}条话题</span>
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
                                                    [<i class="mdui-icon material-icons">local_cafe</i>暂存]
                                                </span>
                                            @endif {{$section->name}}
                                        </div>
                                        <a href="{{route('adminCommunityTopicList',["section_id"=>$section->id])}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>浏览其下{{$section->topic_count}}条话题
                                        </a>
                                        <a href="{{route('adminCommunityTopicCreate',["zone_id"=>$zone->id,"section_id"=>$section->id])}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                                            <i class="mdui-icon material-icons mdui-icon-left">add</i>创建话题
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple mdui-text-color-grey">
                                    <i class="mdui-list-item-icon mdui-icon material-icons">block</i>
                                    <div class="mdui-list-item-content"> 无子分类</div>
                                </div>
                            @endif
                        </ul>
                    </li>
                @endforeach
        </ul>
        <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">注意:含有子级分类的父分类无法被删除,请先删除其所有子分类.</div>

        <button onclick="adminCommunityCatOpenAll()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent adminBtn"><i class="mdui-icon material-icons mdui-icon-left">view_list</i>展开全部</button>
        <button onclick="adminCommunityCatCloseAll()" class="mdui-btn mdui-btn-raised mdui-ripple adminBtn"><i class="mdui-icon material-icons mdui-icon-left">clear</i>收起</button>

        <!--/内容-->
@endsection

