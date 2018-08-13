@extends('frame.indexframe')
@section('title',__('index.community'))
@section('subtitleUrl',route('showCommunity'))
@section('tabActiveVal','community-tab')
@section('bottomNavActiveVal','community-bottom-nav')

@section('content')
    <div class="mdui-card create-page-card" style="margin-top: 20px">
        <form id="createCommunityTopicForm" method="post" action="{{route('communityTopicStore')}}">
            {{csrf_field()}}
            <h1 class="create-page-title mdui-text-color-indigo">
                <i class="mdui-icon material-icons">&#xe0bf;</i>
                创建话题
            </h1>
            @include('admin.layout.msg')
            <div class="mdui-textfield" style="max-width: 500px">
                <h3 class="create-page-part-title mdui-text-color-indigo">1.话题标题</h3>
                <input class="mdui-textfield-input" name="title"/>
            </div>

            <h3 class="create-page-part-title mdui-text-color-indigo mdui-m-t-2">2.所属分区及板块</h3>
            <select name="zone_id" required class="mdui-select" mdui-select="{position: 'bottom'}" onchange="handleSelGetSections(this.value,'sections-to-select')">
                <option value="null">请选择分区</option>
                @foreach($zones as $zone)
                    @if(isset($zone_id)&&$zone_id==$zone->id)
                        <option value="{{$zone->id}}" selected>已选中:{{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name="section_id" required class="mdui-select sections-to-select" id="selectSection">
                <option value="null">请先选择分区</option>
                @if(isset($section_id))
                    @foreach($selectedSections as $section)
                        @if($section_id&&$section_id==$section->id)
                            <option value="{{$section->id}}" selected>已选中:{{$section->name}}</option>
                        @else
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>

            <h3 class="create-page-part-title mdui-text-color-indigo mdui-m-t-2">3.话题内容</h3>
            <div class="mdui-m-t-1 editor-toolbar mdui-hoverable" id="editorToolbar" type="community-topic"></div>
            <div class="editor-middle-bar">编辑区域</div>
            <div id="editorText" contenteditable="true" class="editor-text-for-create-page mdui-hoverable" ></div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

            <div class="mdui-divider" style="margin-top: 50px;margin-bottom: 10px"></div>
            <button onclick="formPublicSubmit('#createCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent"><i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>发布</button>
            <button onclick="formHiddenSubmit('#createCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple"><i class="mdui-icon material-icons mdui-icon-left">&#xe541;</i>暂存</button>
            <a href="{{route('showCommunity')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-m-l-1"><i class="mdui-icon material-icons mdui-icon-left">&#xe5c4;</i>返回社区</a>

        </form>

    </div>
    <!--/内容-->
@endsection