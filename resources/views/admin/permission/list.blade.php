@extends('frame.adminframe')
@section('title','用户及权限管理')
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">权限列表</h3>
    @include('admin.layout.msg')
    <a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>新建权限</a>
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">警告:请谨慎对权限进行编辑修改等操作.</div>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="">标示</th>
                <th class="">关联的角色</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr class="mdui-table-row" id="{{$permission->id}}" name="{{$permission->name}}">
                    <td>
                        {{$permission->id}}
                    </td>
                    <td>
                        {{$permission->name}}
                    </td>
                    <td>
                        @foreach($permission->roles as $role)
                            <div class="mdui-chip">
                                <span class="mdui-chip-title">{{$role->name}}</span>
                                <span onclick="handlePermissionRemoveRole('{{$permission->name}}','{{$permission->id}}','{{$role->name}}','{{$role->id}}')" class="mdui-chip-delete"><i class="mdui-icon material-icons">cancel</i></span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('adminShowUserEdit',$permission->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteUser('{{$permission->id}}','{{$permission->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$permissions->links()}}
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">警告:请谨慎对权限进行编辑修改等操作.</div>
    <button onclick="deleteUsers()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>批量删除</button>

    <!--/内容-->
    @include('layout.register')
@endsection