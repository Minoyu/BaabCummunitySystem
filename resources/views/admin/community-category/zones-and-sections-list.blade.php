@extends('frame.adminframe')
@section('title',__('admin.communityCatManage'))
@section('subtitleUrl',route('adminNewsList'))
@section('adminDrawerActiveVal','drawer-communityCategoryItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/community.communityZonesAndSectionsList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminCommunityZoneCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createZones')}}</a>
    <a href="{{route('adminCommunitySectionCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createSections')}}</a>
        <ul class="mdui-list mdui-color-white mdui-card mdui-hoverable" id="adminCommunityCategoryCollapse" style="border-radius: 5px" >
            @foreach($zones as $zone)
                <li class="mdui-collapse-item " >
                    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                        <div class="mdui-list-item-avatar"><img src="{{$zone->img_url}}"/></div>
                        <div class="mdui-list-item-content">
                            @if($zone->status=='hidden')
                                <span class="mdui-text-color-pink">
                                    <i class="mdui-icon material-icons">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                                </span>
                            @endif
                            {{$zone->name}}
                        </div>
                        <a href="{{route('adminCommunityZoneEdit',$zone->id)}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('admin.edit')}}
                        </a>
                        <a href="" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>{{__('admin.view')}}
                        </a>
                        <a href="{{route('adminCommunitySectionCreate',['zone_id'=>$zone->id])}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                            <i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createSections')}}
                        </a>
                        <button onclick="deleteCommunityZone('{{$zone->id}}','{{$zone->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1 mdui-color-pink-accent" @if(count($zone->communitySections)) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.delete')}}
                        </button>
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
                                                [<i class="mdui-icon material-icons">local_cafe</i>{{__('community.saved')}}]
                                            </span>
                                        @endif {{$section->name}}
                                    </div>
                                    <a href="{{route('adminCommunitySectionEdit',$section->id)}}" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                                        <i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('admin.edit')}}
                                    </a>
                                    <a href="" class="mdui-btn mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1">
                                        <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>{{__('admin.view')}}
                                    </a>
                                    <button onclick="deleteCommunitySection('{{$section->id}}','{{$section->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-m-r-1 mdui-color-pink-accent">
                                        <i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.delete')}}
                                    </button>
                                    <button class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-theme-accent mdui-ripple" style="margin-right: -8px;">
                                        <i class="mdui-icon material-icons">more_vert</i>
                                    </button>
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
        <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">{{__('admin/community.deleteCategoryTip')}}.</div>

        <button onclick="adminCommunityCatOpenAll()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent adminBtn mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">view_list</i>{{__('admin.expendAll')}}</button>
        <button onclick="adminCommunityCatCloseAll()" class="mdui-btn mdui-btn-raised mdui-ripple adminBtn mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">clear</i>{{__('admin.collapse')}}</button>

        <!--/内容-->
@endsection

