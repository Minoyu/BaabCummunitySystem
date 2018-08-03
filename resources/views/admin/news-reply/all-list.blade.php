@extends('frame.adminframe')
@section('title','新闻回复管理')
@section('subtitleUrl',route('adminNewsReplyAllList'))

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">全站新闻回复列表</h3>
    @include('admin.layout.msg')
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>内容</th>
                <th class="mdui-table-col-numeric">来自新闻</th>
                <th class="mdui-table-col-numeric">用户</th>
                <th class="mdui-table-col-numeric">回复时间</th>
                <th style="min-width: 275px" class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr class="mdui-table-row" id="{{$reply->id}}" name="{{str_limit($reply->content, $limit = 30, $end = '...')}}">
                    <td>{!! str_limit($reply->content, $limit = 50, $end = '...')!!}</td>
                    <td>
                        <a href="#">
                            {{str_limit($reply->news->title , $limit = 30, $end = '...')}}
                        </a>
                    </td>
                    <td>{{$reply->user->name}}</td>
                    <td>{{$reply->created_at}}</td>
                    <td>
                        <a href="#" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>查看
                        </a>
                        <a href="{{route('adminNewsReplyEdit',[$reply->news->id,$reply->id])}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNewsReply('{{$reply->id}}','{{str_limit($reply->content, $limit = 20, $end = '...')}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$replies->links()}}
    <button onclick="deleteNewsReplies()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->

@endsection