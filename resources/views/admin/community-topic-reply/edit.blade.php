@extends('frame.adminframe')
@section('title',__('admin.topicRepliesManage'))
@section('subtitleUrl',route('adminCommunityTopicReplyAllList'))
@section('adminDrawerActiveVal','drawer-communityTopicReplyItem')

@section('content')
    <form id="editNewsReplyForm" method="post" action="{{route('adminCommunityTopicReplyUpdate',[$topic->id,$reply->id])}}">
        {{csrf_field()}}
        <h3 class="admin-title mdui-text-color-indigo">{{str_limit($topic->title, $limit = 30, $end = '...')}}－{{__('admin.editReply')}}</h3>
        @include('admin.layout.msg')

        <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">{{__('admin.replyContent')}}</h3>
        <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="topic-reply"></div>
        <div class="admin-editor-middle-bar">{{__('admin.editArea')}}</div>
        <div id="editorText" class="admin-editor-text mdui-hoverable" >{!! $reply->content !!}</div>
        <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>

        <div class="mdui-divider" style="margin-top: 50px"></div>
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
        <a href="{{route('adminCommunityTopicReplyAllList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
        <div class="mdui-divider" style="margin-bottom: 200px"></div>



    </form>
        <!--/内容-->
@endsection
