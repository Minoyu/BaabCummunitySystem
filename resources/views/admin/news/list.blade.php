@extends('frame.adminframe')
@section('title','新闻管理')
@section('subtitleUrl',route('adminNewsList'))
@section('adminDrawerActiveVal','drawer-newsItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">新闻列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminNewsCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>创建新闻分类</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>新闻名称</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">发布者</th>
                <th class="mdui-table-col-numeric">浏览量</th>
                <th class="mdui-table-col-numeric">回复量</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th style="min-width: 275px" class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newses as $news)
                <tr class="mdui-table-row" id="{{$news->id}}" name="{{$news->title}}">
                    <td>@if($news->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif <a href="{{route('showNewsContent',$news->id)}}" target="_blank">{{$news->title}}</a></td>
                    <td>{{$news->id}}</td>
                    <td>{{$news->user->name}}</td>
                    <td>{{$news->view_count}}</td>
                    <td>
                        <a href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense mdui-color-indigo-400 admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">comment</i>{{$news->reply_count}}
                        </a>
                    </td>
                    <td>{{$news->order}}</td>
                    <td>
                        <a href="{{route('showNewsContent',$news->id)}}" target="_blank" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>查看
                        </a>
                        <a href="{{route('adminNewsEdit',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNews('{{$news->id}}','{{$news->title}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($news->order>=0&&$news->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($news->order>0&&$news->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('newsTurnUpNewsOrder',$news->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('newsTurnDownNewsOrder',$news->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newses->links()}}
    <button onclick="deleteNewses()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->

@endsection