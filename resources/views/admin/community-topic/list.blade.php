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
                <th class="mdui-table-col-numeric">分区</th>
                <th class="mdui-table-col-numeric">发布者</th>
                <th class="mdui-table-col-numeric">浏览量</th>
                <th class="mdui-table-col-numeric">回复量</th>
                {{--<th class="mdui-table-col-numeric">点赞数</th>--}}
                <th class="mdui-table-col-numeric">优先级</th>
                <th style="min-width: 275px" class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr class="mdui-table-row" id="{{$topic->id}}" name="{{str_limit($topic->title, $limit = 30, $end = '...')}}">
                    <td>@if($topic->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif {{str_limit($topic->title, $limit = 40, $end = '...')}}</td>
                    <td>{{$topic->id}}</td>
                    <td>{{$topic->communitySection->name}}</td>
                    <td>{{$topic->user->name}}</td>
                    <td>{{$topic->view_count}}</td>
                    <td>
                        <a href="" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense mdui-color-indigo-400 admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">comment</i>{{$topic->reply_count}}
                        </a>
                    </td>
                    <td>{{$topic->order}}</td>
                    <td>
                        <a href="#" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>查看
                        </a>
                        <a href="{{route('adminCommunityTopicEdit',$topic->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNews('{{$topic->id}}','{{$topic->title}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($topic->order>=0&&$topic->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($topic->order>0&&$topic->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('communityTopicTurnUpOrder',$topic->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('communityTopicTurnDownOrder',$topic->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>
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
    <button onclick="deleteNewses()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->

@endsection