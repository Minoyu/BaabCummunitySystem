@extends('frame.adminframe')
@section('title','用户及权限管理')
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">用户列表</h3>
    @include('admin.layout.msg')
    <a onclick="openRegisterDialog()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>创建新用户</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>头像</th>
                <th>用户名</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">话题数</th>
                <th class="mdui-table-col-numeric">回复数</th>
                <th class="mdui-table-col-numeric">关注数</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user_collection as $user_item)
                <tr class="mdui-table-row" id="{{$user_item['user']->id}}" name="{{$user_item['user']->name}}">
                    <td>
                        <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
                            <img src="{{$user_item['user']->info->avatar_url}}" style="width: 50px;height: 50px;border-radius: 50%">
                        </a>
                    </td>
                    <td>
                        <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
                            {{$user_item['user']->name}}
                            <br>
                            <small style="opacity: 0.8">{{$user_item['user']->email}}</small>
                        </a>
                    </td>
                    <td>{{$user_item['user']->id}}</td>
                    <td>{{$user_item['topicsCount']}}</td>
                    <td>{{$user_item['repliesCount']}}</td>
                    <td>{{$user_item['followingsCount']}}</td>
                    <td>
                        <a target="_blank" href="{{route('adminShowUserEdit',$user_item['user']->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteUser('{{$user_item['user']->id}}','{{$user_item['user']->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$users->links()}}
    <button onclick="deleteUsers()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->
    @include('layout.register')
@endsection