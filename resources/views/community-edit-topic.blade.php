@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')

@section('content')
    <div class="mdui-card create-page-card" style="margin-top: 20px">
        <form id="editCommunityTopicForm" method="post" action="{{route('communityTopicUpdate',$topic->id)}}">
            {{csrf_field()}}
            <h1 class="create-page-title mdui-text-color-indigo">
                <i class="mdui-icon material-icons">&#xe0bf;</i>
                {{__('admin.edit')}}{{__('community.topics')}}
            </h1>
            @include('admin.layout.msg')
            <div class="mdui-textfield" style="max-width: 500px">
                <h3 class="create-page-part-title mdui-text-color-indigo">1.{{__('admin.topicTitle')}}</h3>
                <input class="mdui-textfield-input" name="title" value="{{$topic->title}}"/>
            </div>

            <h3 class="create-page-part-title mdui-text-color-indigo mdui-m-t-4">2.{{__('admin.selectZonesAndSections')}}</h3>
            <select name="zone_id" required class="mdui-select" mdui-select="{position: 'bottom'}" onchange="handleSelGetSections(this.value,'sections-to-select')">
                <option value="null">{{__('admin.selectZonesP')}}</option>
                @foreach($zones as $zone)
                    @if($topic->zone_id==$zone->id)
                        <option value="{{$zone->id}}" selected>{{__('admin.current')}}: {{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name="section_id" required class="mdui-select sections-to-select" id="selectSection">
                <option value="null">{{__('admin.selectZonesPF')}}</option>
                    @foreach($selectedSections as $section)
                        @if($topic->section_id==$section->id)
                            <option value="{{$section->id}}" selected>{{__('admin.current')}}: {{$section->name}}</option>
                        @else
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endif
                    @endforeach
            </select>

            <h3 class="create-page-part-title mdui-text-color-indigo mdui-m-t-4">3.{{__('admin.topicContent')}}</h3>
            <div class="mdui-m-t-1 editor-toolbar mdui-hoverable" id="editorToolbar" type="community-topic"></div>
            <div class="editor-middle-bar">{{__('admin.editArea')}}</div>
            <div id="editorText" class="editor-text-for-create-page mdui-hoverable" >{!! $topic->content !!}</div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

            <div class="mdui-divider" style="margin-top: 50px;"></div>
            <button onclick="formPublicSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-m-l-1 mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">&#xe541;</i>{{__('admin.save')}}</button>
            <a href="{{route('showCommunity')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-m-l-1 mdui-m-t-1"><i class="mdui-icon material-icons mdui-icon-left">&#xe5c4;</i>{{__('index.backTo')}}{{__('index.community')}}</a>

        </form>

    </div>
    <!--/内容-->
@endsection