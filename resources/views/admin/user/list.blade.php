@extends('frame.adminframe')
@section('title',__('admin.usersAndPermissionsManage'))
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin.usersList')}}</h3>
    @include('admin.layout.msg')
    <a onclick="openRegisterDialog()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('user.createUser')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th class="">ID</th>
                <th>{{__('user.avatar')}}</th>
                <th>{{__('admin/user-permission.roles')}}</th>
                <th>{{__('user.username')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.postsCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.commentCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('user.followers')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
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
                                    <div mdui-tooltip="{content: '{{__('user.assignRoles')}}', position: 'top'}" onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-pink-accent">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('Maintainer')
                                    <div mdui-tooltip="{content: '{{__('user.assignRoles')}}', position: 'top'}" onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-blue-accent">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('NormalUser')
                                    <div mdui-tooltip="{content: '{{__('user.assignRoles')}}', position: 'top'}" onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-blue-grey">
                                        <span class="mdui-chip-title">{{$role->name}}</span>
                                    </div>
                                    @break
                                @case('BanedUser')
                                    <div mdui-tooltip="{content: '{{__('user.assignRoles')}}', position: 'top'}" onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-chip mdui-color-grey mdui-text-color-white">
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
                    <td>{{$user_item['followersCount']}}</td>
                    <td>
                        <a mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" target="_blank" href="{{route('adminShowUserEdit',$user_item['user']->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button  mdui-tooltip="{content: '{{__('user.assignRoles')}}', position: 'top'}" onclick="handleChangeUserRoles('{{$user_item['user']->name}}','{{$user_item['user']->id}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-blue-grey">
                            <i class="mdui-icon material-icons">account_box</i>
                        </button>
                        <button  mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteUser('{{$user_item['user']->id}}','{{$user_item['user']->name}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$users->links()}}
    <button onclick="deleteUsers()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    {{--更改角色对话框--}}
    <div class="mdui-dialog" id="changeRolesDialog">
        <div class="mdui-dialog-title">{!! __('user.assignRoleFor')!!}</div>
        <div class="mdui-dialog-content">
            {{__('admin/user-permission.roleHasPermissionsTip')}}
            <br>
            <br>
            <div class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">{{__('admin/user-permission.roles')}}</label>
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
    @include('layout.registerByEmail')
    @include('layout.registerByPhone')
@endsection