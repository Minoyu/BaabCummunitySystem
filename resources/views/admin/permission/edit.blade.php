@extends('frame.adminframe')
@section('title','用户及权限管理')
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')

    <h3 class="admin-title mdui-text-color-indigo">编辑权限
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent mdui-float-right"><i class="mdui-icon material-icons mdui-icon-left">edit</i>确认编辑</button>
    </h3>
    @include('admin.layout.msg')
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">警告:请谨慎对权限进行编辑修改等操作.</div>
    <form action="{{route('adminPermissionUpdate',$permission->id)}}" method="post">
        {{csrf_field()}}
        <div class="mdui-row">
            <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                <h3 class="admin-index-title mdui-text-color-indigo">1.权限标示</h3>
                <input class="mdui-textfield-input" name="name" type="text" value="{{$permission->name}}" required/>
                <div class="mdui-textfield-error">权限标示是必须的</div>
            </div>
        </div>

        <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">2.拥有此权限的用户组
            <br><small class="show-file-title-sub">下方多选框选中即可</small>
        </h3>

        <div class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">用户组</label>
                <div class="layui-input-block">
                    @foreach($roles as $role)
                        <input type="checkbox" name="role_id[]" value="{{$role->id}}" title="{{$role->name}}" @if($role->hasPermissionTo($permission->id)) checked @endif>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="mdui-divider" style="margin-top: 50px"></div>
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">edit</i>确认编辑</button>
        <a href="{{route('adminShowPermissionsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回到权限列表</a>
        <div class="mdui-divider" style="margin-bottom: 200px"></div>

    </form>


@endsection