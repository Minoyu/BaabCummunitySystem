@extends('frame.adminframe')
@section('title',__('admin.topicRepliesManage'))
@section('subtitleUrl',route('adminCommunityTopicReplyAllList'))
@section('adminDrawerActiveVal','drawer-communityTopicReplyItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/community.allTopicRepliesList')}}</h3>
    @include('admin.layout.msg')
    <div class="mdui-table-fluid mdui-m-t-2">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin.replyContent')}}</th>
                <th class="">{{__('admin/community.fromTopic')}}</th>
                <th class="">{{__('index.author')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.time')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr class="mdui-table-row" id="{{$reply->id}}" name="{{str_limit($reply->content, $limit = 30, $end = '...')}}">
                    <td>{!! str_limit($reply->content, $limit = 50, $end = '...')!!}</td>
                    <td>
                        <a href="{{route('showCommunityContent',$reply->communityTopic->id)}}">
                            {{str_limit($reply->communityTopic->title , $limit = 30, $end = '...')}}
                        </a>
                    </td>
                    <td>{{$reply->user->name}}</td>
                    <td>{{$reply->created_at}}</td>
                    <td>
                        <a mdui-tooltip="{content: '{{__('admin.view')}}', position: 'top'}" target="_blank" href="{{route('showCommunityContent',$reply->communityTopic->id)}}#reply-{{$reply->id}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">remove_red_eye</i>
                        </a>
                        <a mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminCommunityTopicReplyEdit',[$reply->communityTopic->id,$reply->id])}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteCommunityTopicReply('{{$reply->id}}','{{str_limit($reply->content, $limit = 20, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$replies->links()}}
    <button onclick="deleteCommunityTopicReplies()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    <!--/内容-->

@endsection