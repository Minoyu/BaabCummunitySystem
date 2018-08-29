@extends('frame.adminframe')
@section('title',__('admin.communityTopicsManage'))
@section('subtitleUrl',route('adminCommunityTopicList'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">
        @if($selectedSection)
            {{$section->name}}——{{__('admin/community.topicsList')}}
        @else
            {{__('admin/community.allTopicsList')}}
        @endif
    </h3>
    @include('admin.layout.msg')
    <a href="{{route('adminCommunityTopicCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn">
        <i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createTopics')}}
    </a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin.topicTitle')}}</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('community.section')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.author')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.visitedCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.commentCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.likedCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr class="mdui-table-row" id="{{$topic->id}}" name="{{str_limit($topic->title, $limit = 30, $end = '...')}}">
                    <td>@if($topic->status=='hidden')
                            <span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                        @endif
                        @if($topic->order >0)
                            <span class="layui-badge">{{__('community.sticky')}}</span>
                        @endif
                        @if($topic->is_excellent)
                            <span class="layui-badge layui-bg-blue">{{__('community.excellent')}}</span>
                        @endif
                        @if($topic->order <0)
                            <span class="layui-badge layui-bg-black">{{__('community.sink')}}</span>
                        @endif

                        <a target="_blank" href="{{route('showCommunityContent',$topic->id)}}">{{str_limit($topic->title, $limit = 40, $end = '...')}}</a>
                    </td>
                    <td>{{$topic->id}}</td>
                    <td>{{$topic->communitySection->name}}</td>
                    <td>{{$topic->user->name}}</td>
                    <td>{{$topic->view_count}}</td>
                    <td>
                        <a href="{{route('adminCommunityTopicReplyList',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense mdui-color-indigo-400 admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">comment</i>{{$topic->reply_count}}
                        </a>
                    </td>
                    <td>{{$topic->countVoters()}}</td>
                    <td>{{$topic->order}}</td>
                    <td>
                        <a  mdui-tooltip="{content: '{{__('admin.view')}}', position: 'top'}" target="_blank" href="{{route('showCommunityContent',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">remove_red_eye</i>
                        </a>
                        <a  mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" href="{{route('communityTopicTurnUpOrder',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange">
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a  mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" href="{{route('communityTopicTurnDownOrder',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-teal">
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>
                        @if(!$topic->is_excellent)
                            <a mdui-tooltip="{content: '{{__('admin.setExcellent')}}', position: 'top'}" href="{{route('communityTopicToggleExcellent',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue">
                                <i class="mdui-icon material-icons">thumb_up</i>
                            </a>
                        @else
                            <a mdui-tooltip="{content: '{{__('admin.removeExcellent')}}', position: 'top'}" href="{{route('communityTopicToggleExcellent',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-grey-500">
                                <i class="mdui-icon material-icons">thumb_down</i>
                            </a>
                        @endif
                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminCommunityTopicEdit',$topic->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button  mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteCommunityTopic('{{$topic->id}}','{{$topic->title}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($selectedSection)
        {{$topics->appends(['section_id'=>$section->id])->links()}}
    @else
        {{$topics->links()}}
    @endif
    <button onclick="deleteCommunityTopics()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    <!--/内容-->

@endsection