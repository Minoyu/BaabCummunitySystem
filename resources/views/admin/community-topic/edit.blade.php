@extends('frame.adminframe')
@section('title','社区话题管理')
@section('subtitleUrl',route('adminCommunityTopicList'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
        <form id="editCommunityTopicForm" method="post" action="{{route('adminCommunityTopicUpdate',$topic->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">编辑话题</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.话题标题</h3>
                    <label class="mdui-textfield-label">请输入话题标题</label>
                    <input class="mdui-textfield-input" name="title" value="{{$topic->title}}"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">2.所属分区及板块</h3>
            <select name="zone_id" class="mdui-select" mdui-select="{position: 'bottom'}" onchange="handleSelGetSections(this.value,'sections-to-select')">
                <option value="null">请选择分区</option>
                @foreach($zones as $zone)
                    @if($topic->zone_id==$zone->id)
                        <option value="{{$zone->id}}" selected>当前:{{$zone->name}}</option>
                    @else
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name="section_id" class="mdui-select sections-to-select" id="adminSelectSection">
                <option value="null">请先选择分区</option>
                @foreach($selectedSections as $section)
                    @if($topic->section_id==$section->id)
                        <option value="{{$section->id}}" selected>当前:{{$section->name}}</option>
                    @else
                        <option value="{{$section->id}}">{{$section->name}}</option>
                    @endif
                @endforeach
            </select>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">3.话题内容</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="community-topic"></div>
            <div class="admin-editor-middle-bar">编辑区域</div>
            <div id="editorText" class="admin-editor-text mdui-hoverable" >{!! $topic->content !!}</div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.优先级
                <br><small class="show-file-title-sub">优先级范围-5～5，从左到右递增。
                <br>正常为0，大于0标记 <span class="layui-badge">置顶</span>，小于0标记 <span class="layui-badge layui-bg-black">下沉</span>
                <br>话题将先依照优先级排序，相同优先级下依照发布时间排序
                </small>
            </h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="-5" max="5" value="{{$topic->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="formHiddenSubmit('#editCommunityTopicForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminNewsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
