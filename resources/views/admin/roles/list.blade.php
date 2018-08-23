@extends('frame.adminframe')
@section('title','用户及权限管理')
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">角色列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminShowCreateRole')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn">
        <i class="mdui-icon material-icons mdui-icon-left">add</i>新建角色
    </a>
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">警告:请谨慎对角色进行编辑修改等操作.</div>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="">角色</th>
                <th class="">关联的权限</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr class="mdui-table-row" id="{{$role->id}}" name="{{$role->name}}">
                    <td>
                        {{$role->id}}
                    </td>
                    <td>
                        {{$role->name}}
                    </td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <div class="mdui-chip">
                                <span class="mdui-chip-title">{{$permission->name}}</span>
                                <span onclick="handleRoleRemovePermission('{{$permission->name}}','{{$permission->id}}','{{$role->name}}','{{$role->id}}')" class="mdui-chip-delete"><i class="mdui-icon material-icons">cancel</i></span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('adminShowRoleEdit',$role->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteRole('{{$role->id}}','{{$role->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$roles->links()}}
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">警告:请谨慎对角色进行编辑修改等操作.</div>

    <!--/内容-->
    @include('layout.register')
@endsection