@extends('frame.adminframe')
@section('title','社区话题管理')
@section('subtitleUrl',route('adminCommunityTopicList'))
@section('adminDrawerActiveVal','drawer-communityTopicItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">
        @if($selectedSection)
            {{$section->name}}——话题列表
        @else
            全站话题列表
        @endif
    </h3>
    @include('admin.layout.msg')
    <a href="{{route('adminCommunityTopicCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn">
        <i class="mdui-icon material-icons mdui-icon-left">add</i>创建新话题
    </a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>话题名称</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('community.section')}}</th>
                <th class="mdui-table-col-numeric">发布者</th>
                <th class="mdui-table-col-numeric">{{__('community.visitedCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.commentCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.likedCount')}}</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th style="min-width: 275px" class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr class="mdui-table-row" id="{{$topic->id}}" name="{{str_limit($topic->title, $limit = 30, $end = '...')}}">
                    <td>@if($topic->status=='hidden')
                            <span class="layui-badge layui-bg-orange">暂存</span>
                        @endif
                        @if($topic->order >0)
                            <span class="layui-badge">置顶</span>
                        @endif
                        @if($topic->is_excellent)
                            <span class="layui-badge layui-bg-blue">精华</span>
                        @endif
                        @if($topic->order <0)
                            <span class="layui-badge layui-bg-black">下沉</span>
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
                        <a target="_blank" href="{{route('showCommunityContent',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>查看
                        </a>
                        <a href="{{route('adminCommunityTopicEdit',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteCommunityTopic('{{$topic->id}}','{{$topic->title}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        <a href="{{route('communityTopicTurnUpOrder',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange">
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>上升
                        </a>
                        <a href="{{route('communityTopicTurnDownOrder',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue">
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>下降
                        </a>
                        @if(!$topic->is_excellent)
                            <a href="{{route('communityTopicToggleExcellent',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-blue mdui-text-color-white">
                                <i class="mdui-icon material-icons mdui-icon-left">thumb_up</i>设为精华
                            </a>
                        @else
                            <a href="{{route('communityTopicToggleExcellent',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue">
                                <i class="mdui-icon material-icons mdui-icon-left">thumb_down</i>取消精华
                            </a>
                        @endif
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
    <button onclick="deleteCommunityTopics()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->

@endsection