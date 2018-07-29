@extends('frame.adminframe')
@section('title','新闻管理')
@section('subtitleUrl',route('adminNewsList'))

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
                <th class="mdui-table-col-numeric">回复数</th>
                <th class="mdui-table-col-numeric">浏览量</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newses as $news)
                <tr class="mdui-table-row" id="{{$news->id}}" name="{{$news->title}}">
                    <td>@if($news->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif {{$news->title}}</td>
                    <td>{{$news->id}}</td>
                    <td>{{$news->user->name}}</td>
                    <td>{{$news->view_count}}</td>
                    <td>{{$news->replay_count}}</td>
                    <td>{{$news->order}}</td>
                    <td>
                        <a href="{{route('adminNewsEdit',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>查看
                        </a>
                        <a href="{{route('adminNewsEdit',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNewsCategory('{{$news->id}}','{{$news->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newses->links()}}
    <button onclick="deleteNewsCategories()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->

@endsection