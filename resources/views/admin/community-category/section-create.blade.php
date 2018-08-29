@extends('frame.adminframe')
@section('title',__('admin.communityCatManage'))
@section('subtitleUrl',route('adminCommunityZonesAndSectionsShow'))
@section('adminDrawerActiveVal','drawer-communityCategoryItem')

@section('content')
        <form id="createCommunitySectionForm" method="post" action="{{route('adminCommunitySectionStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/community.createCommunitySections')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/community.sectionTitle')}}</h3>
                    <label class="mdui-textfield-label">{{__('admin/community.sectionTitleTip')}}</label>
                    <input class="mdui-textfield-input" name="name"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin/community.selZone')}}</h3>
            <select name="zone_id" class="mdui-select" mdui-select="{position: 'bottom'}">
                <option value="null">{{__('admin/community.selZoneP')}}</option>
                @foreach($zones as $zone)
                    @if($selectedZone && $selectedZone == $zone->id)
                        <option value="{{$zone->id}}" selected>{{__('admin.selected')}}： {{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin/community.sectionDescription')}}</h3>
                <label class="mdui-textfield-label">{{__('admin/community.sectionDescriptionTip')}}</label>
                <textarea class="mdui-textfield-input" name="description" required></textarea>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin/community.sectionCover')}}
                <br><small class="show-file-title-sub">{{__('admin/community.sectionCoverTip')}}</small></h3>
            <label for="newsCoverUploadInput">
                <img src="/imgs/section_default.jpg" class="avatar mdui-hoverable sectionImg" style="width: 150px; height: 150px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleZoneImgUpdate(this,'sectionImg')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="img_url">

            <h3 class="admin-index-title mdui-text-color-indigo">5.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/community.priorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin/community.priorityTip2')}}</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createCommunitySectionForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#createCommunitySectionForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminCommunityZonesAndSectionsShow')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>

        </form>
        <!--/内容-->
@endsection
