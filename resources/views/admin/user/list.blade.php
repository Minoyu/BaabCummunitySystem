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
                <th class="">ID</th>
                <th>头像</th>
                <th>角色</th>
                <th>用户名</th>
                <th class="mdui-table-col-numeric">话题数</th>
                <th class="mdui-table-col-numeric">回复数</th>
                <th class="mdui-table-col-numeric">关注数</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user_collection as $user_item)
                <tr class="mdui-table-row" id="{{$user_item['user']->id}}" name="{{$user_item['user']->name}}">
                    <td>{{$user_item['user']->id}}</td>
                    <td>
                        <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
                            <img src="{{$user_item['user']->info->avatar_url}}" class="mdui-hoverable" style="width: 50px;height: 50px;border-radius: 50%">
                        </a>
                    </td>
                    <td>
                        @foreach($user_item['user']->roles as $role)
                            @switch($role->name)
                                @case('Founder')
                                    <div onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-pink-accent">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('Maintainer')
                                    <div onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-blue-accent">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('NormalUser')
                                    <div onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-blue-grey">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('BanedUser')
                                    <div onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-grey mdui-text-color-white">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                            @endswitch
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
                            {{$user_item['user']->name}}
                            <br>
                            <small style="opacity: 0.8">{{$user_item['user']->email}}</small>
                        </a>
                    </td>
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
                        <br>
                        <button onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-blue-grey">
                            <i class="mdui-icon material-icons mdui-icon-left">account_circle</i>指定角色
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$users->links()}}
    <button onclick="deleteUsers()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    {{--更改角色对话框--}}
    <div class="mdui-dialog" id="changeRolesDialog">
        <div class="mdui-dialog-title">为用户 <span id="changeRolesUserName"></span> 指定角色</div>
        <div class="mdui-dialog-content">
            在下方多选框选中即可
            <br>
            <br>
            <div class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">用户组</label>
                    <div class="layui-input-block">
                        @foreach($roles as $role)
                            <input type="checkbox" name="role_id[]" value="{{$role->id}}" title="{{$role->name}}">
                        @endforeach
                    </div>
                </div>
            </div>
            <input id="changeRolesUserId" name="userId" class="mdui-hidden">
        </div>
        <div class="mdui-dialog-actions">
            <button class="mdui-btn mdui-ripple" mdui-dialog-close>cancel</button>
            <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>OK</button>
        </div>
    </div>

    <!--/内容-->
    @include('layout.register')
@endsection