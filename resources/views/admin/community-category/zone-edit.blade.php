@extends('frame.adminframe')
@section('title',__('admin.communityCatManage'))
@section('subtitleUrl',route('adminCommunityZonesAndSectionsShow'))
@section('adminDrawerActiveVal','drawer-communityCategoryItem')

@section('content')

        <form id="editCommunityZoneForm" method="post" action="{{route('adminCommunityZoneUpdate',$zone->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/community.editCommunityZone')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/community.zoneTitle')}}</h3>
                    <label class="mdui-textfield-label">{{__('admin/community.zoneTitleTip')}}</label>
                    <input class="mdui-textfield-input" name="name" value="{{$zone->name}}"/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin/community.zoneDescription')}}</h3>
                <label class="mdui-textfield-label">{{__('admin/community.zoneDescriptionTip')}}</label>
                <textarea class="mdui-textfield-input" name="description" required>{{$zone->description}}</textarea>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin/community.zoneCover')}}
                <br><small class="show-file-title-sub">{{__('admin/community.zoneCoverEditTip')}}</small></h3>
            <label for="newsCoverUploadInput">
                <img src="{{$zone->img_url}}" class="avatar mdui-hoverable zoneImg" style="width: 150px; height: 150px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleZoneImgUpdate(this,'zoneImg')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="img_url" value="{{$zone->img_url}}">

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/community.zonePriorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin/community.zonePriorityTip2')}}</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="{{$zone->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editCommunityZoneForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#editCommunityZoneForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminCommunityZonesAndSectionsShow')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
