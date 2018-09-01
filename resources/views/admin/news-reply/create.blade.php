@extends('frame.adminframe')
@section('title',__('admin.newsReplyManage'))
@section('subtitleUrl',route('adminNewsReplyAllList'))
@section('adminDrawerActiveVal','drawer-newsReplyItem')

@section('content')
        <form id="createNewsReplyForm" method="post" action="{{route('adminNewsReplyStore',$news->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{str_limit($news->title, $limit = 30, $end = '...')}}－{{__('admin/news.createReply')}}</h3>
            @include('admin.layout.msg')

            <h3 class="admin-index-title mdui-text-color-indigo">{{__('admin.replyContent')}}</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="news-reply"></div>
            <div class="admin-editor-middle-bar">{{__('admin.editArea')}}</div>
            <div id="editorText" class="admin-editor-text mdui-hoverable" ></div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>
            <div class="mdui-progress">
                <div class="mdui-progress-indeterminate" id="editor-progress" style="display: none"></div>
            </div>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <a href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
