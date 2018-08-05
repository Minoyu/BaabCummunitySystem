@extends('frame.adminframe')
@section('title','新闻回复管理')
@section('subtitleUrl',route('adminNewsReplyList',$news->id))
@section('adminDrawerActiveVal','drawer-newsReplyItem')

@section('content')
        <form id="createNewsReplyForm" method="post" action="{{route('adminNewsReplyStore',$news->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{str_limit($news->title, $limit = 30, $end = '...')}}－创建回复</h3>
            @include('admin.layout.msg')

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">回复内容</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="news-reply"></div>
            <div class="admin-editor-middle-bar">编辑区域</div>
            <div contenteditable="true" id="editorText" class="admin-editor-text mdui-hoverable" ><p>在此编辑回复内容</p></div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <a href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
