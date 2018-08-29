@extends('frame.adminframe')
@section('title',__('admin.communityTopicsManage'))
@section('subtitleUrl',route('adminCommunityTopicList'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
        <form id="editCommunityTopicForm" method="post" action="{{route('adminCommunityTopicUpdate',$topic->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/community.editTopic')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin.topicTitle')}}</h3>
                    <input class="mdui-textfield-input" name="title" value="{{$topic->title}}"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin.selectZonesAndSections')}}</h3>
            <select name="zone_id" class="mdui-select" mdui-select="{position: 'bottom'}" onchange="handleSelGetSections(this.value,'sections-to-select')">
                <option value="null">{{__('admin.selectZonesP')}}</option>
                @foreach($zones as $zone)
                    @if($topic->zone_id==$zone->id)
                        <option value="{{$zone->id}}" selected>{{__('admin.current')}}:{{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name="section_id" class="mdui-select sections-to-select" id="adminSelectSection">
                <option value="null">{{__('admin.selectZonesPF')}}</option>
                @foreach($selectedSections as $section)
                    @if($topic->section_id==$section->id)
                        <option value="{{$section->id}}" selected>{{__('admin.current')}}:{{$section->name}}</option>
                    @else
                        <option value="{{$section->id}}">{{$section->name}}</option>
                    @endif
                @endforeach
            </select>

            <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin.topicContent')}}</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="community-topic"></div>
            <div class="admin-editor-middle-bar">{{__('admin.editArea')}}</div>
            <div id="editorText" class="admin-editor-text mdui-hoverable" >{!! $topic->content !!}</div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/community.topicPriorityTip1')}}
                    <br>{{__('admin/community.topicPriorityTip2-1')}} <span class="layui-badge">{{__('community.sticky')}}</span>{{__('admin/community.topicPriorityTip2-2')}} <span class="layui-badge layui-bg-black">{{__('community.sink')}}</span>
                    <br>{{__('admin/community.topicPriorityTip3')}}
                </small>
            </h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="-5" max="5" value="{{$topic->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminCommunityTopicList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
