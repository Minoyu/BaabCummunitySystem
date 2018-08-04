@extends('frame.adminframe')
@section('title','社区板块管理')
@section('subtitleUrl',route('adminCommunityZonesAndSectionsShow'))
@section('adminDrawerActiveVal','drawer-communityCategoryItem')

@section('content')
        <form id="editCommunitySectionForm" method="post" action="{{route('adminCommunitySectionUpdate',$section->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">编辑社区板块</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.编辑板块名称</h3>
                    <label class="mdui-textfield-label">请输入社区板块名称</label>
                    <input class="mdui-textfield-input" name="name" value="{{$section->name}}"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">2.所属板块</h3>
            <select name="zone_id" class="mdui-select" mdui-select="{position: 'bottom'}">
                <option value="null">请选择分区</option>
                @foreach($zones as $zone)
                    @if($section->zone_id == $zone->id)
                        <option value="{{$zone->id}}" selected>当前：{{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.编辑板块描述</h3>
                <label class="mdui-textfield-label">请输入板块的描述用于展示</label>
                <textarea class="mdui-textfield-input" name="description" required>{{$section->description}}</textarea>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.板块封面图
                <br><small class="show-file-title-sub">点击下方图片上传,留空则使用默认</small></h3>
            <label for="newsCoverUploadInput">
                <img src="{{$section->img_url}}" class="avatar mdui-hoverable sectionImg" style="width: 150px; height: 150px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleZoneImgUpdate(this,'sectionImg')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="img_url" value="{{$section->img_url}}">

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">5.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">板块将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="{{$section->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editCommunitySectionForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="formHiddenSubmit('#editCommunitySectionForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminCommunityZonesAndSectionsShow')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>

        </form>
        <!--/内容-->
@endsection
