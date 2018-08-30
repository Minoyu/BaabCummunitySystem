@extends('frame.adminframe')
@section('title',__('admin.usersAndPermissionsManage'))
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')

    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/user-permission.createRole')}}
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent mdui-float-right"><i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('admin/user-permission.confirmCreate')}}</button>
    </h3>
    @include('admin.layout.msg')
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">{{__('admin/user-permission.roleNote')}}</div>
    <form action="{{route('adminRoleStore')}}" method="post">
        {{csrf_field()}}
        <div class="mdui-row">
            <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/user-permission.roleSign')}}</h3>
                <input class="mdui-textfield-input" name="name" type="text" required/>
                <div class="mdui-textfield-error">{{__('admin/user-permission.roleSignTip')}}</div>
            </div>
        </div>

        <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-3 mdui-m-b-1">2.{{__('admin/user-permission.roleHasPermissions')}}
            <br><small class="show-file-title-sub">{{__('admin/user-permission.roleHasPermissionsTip')}}</small>
        </h3>

        <div class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">{{__('admin/user-permission.permissions')}}</label>
                <div class="layui-input-block">
                    @foreach($permissions as $permission)
                        <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" title="{{$permission->name}}">
                    @endforeach
                </div>
            </div>
        </div>


        <div class="mdui-divider" style="margin-top: 50px"></div>
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('admin/user-permission.confirmCreate')}}</button>
        <a href="{{route('adminShowRolesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('admin/user-permission.backToRolesList')}}</a>
        <div class="mdui-divider" style="margin-bottom: 200px"></div>

    </form>


@endsection