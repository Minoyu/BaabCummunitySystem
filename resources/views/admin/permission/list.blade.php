@extends('frame.adminframe')
@section('title',__('admin.usersAndPermissionsManage'))
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/user-permission.permissionList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminShowCreatePermission')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn">
        <i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin/user-permission.createPermission')}}
    </a>
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">{{__('admin/user-permission.permissionNote')}}</div>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="">{{__('admin/user-permission.permissionSign')}}</th>
                <th class="">{{__('admin/user-permission.rolesWithThisPermission')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
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
                                <span  mdui-tooltip="{content: '{{__('admin/user-permission.removeThisRole')}}', position: 'top'}" onclick="handlePermissionRemoveRole('{{$permission->name}}','{{$permission->id}}','{{$role->name}}','{{$role->id}}')" class="mdui-chip-delete"><i class="mdui-icon material-icons">cancel</i></span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" target="_blank" href="{{route('adminShowPermissionEdit',$permission->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deletePermission('{{$permission->id}}','{{$permission->name}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$permissions->links()}}
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">{{__('admin/user-permission.permissionNote')}}</div>

    <!--/内容-->
    @include('layout.register')
@endsection