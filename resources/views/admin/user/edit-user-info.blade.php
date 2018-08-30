@extends('frame.adminframe')
@section('title',__('admin.usersAndPermissionsManage'))
@section('subtitleUrl',route('adminShowUsersList'))
@section('adminDrawerActiveVal','drawer-userItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('user.editPersonalInformation')}}
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent mdui-float-right"><i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('user.confirmUpdate')}}</button>

    </h3>
    @include('admin.layout.msg')

    <form action="{{route('adminUserEditUpdate',$user->id)}}" method="post">
        {{csrf_field()}}
        <div class="mdui-row">
            <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('user.username')}}</h3>
                <input class="mdui-textfield-input" name="name" type="text" value="{{$user->name}}" required/>
                <div class="mdui-textfield-error">{{__('auth.nameEmpty')}}</div>
            </div>
        </div>
        <div class="mdui-row">
            <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('user.changePassword')}}
                    <br><small class="show-file-title-sub">{{__('user.changePasswordTip')}}</small>
                </h3>
                <input class="mdui-textfield-input" name="password" type="password"/>
                <div class="mdui-textfield-error">{{__('auth.atLeast6')}}</div>
            </div>
        </div>

        <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('user.userAvatar')}}
            <br><small class="show-file-title-sub">{{__('user.userAvatarTip')}}</small>
        </h3>
        <label for="newsCoverUploadInput">
            <img src="{{$user->info->avatar_url}}" class="avatar mdui-hoverable userAvatar" style="width: 150px; height: 150px">
        </label>
        <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleAvatarUpdate(this,'userAvatar')" accept="image/jpeg,image/png">
        <input class="mdui-hidden" name="userId" value="{{$user->id}}">


        <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('user.userInfoPart')}}</h3>
        <div class="mdui-dialog-content">
            <div class="user-info-box">
                <div class="mdui-textfield short-textfield">
                    <label class="mdui-textfield-label">{{__('user.sex')}}</label>
                    <label class="mdui-radio mdui-m-x-2">
                        <input type="radio" name="sex" value="male" @if($user->info->sex=='male') checked @endif/>
                        <i class="mdui-radio-icon"></i>
                        {{__('user.male')}}
                    </label>

                    <label class="mdui-radio mdui-m-x-2">
                        <input type="radio" name="sex" value="female" @if($user->info->sex=='female') checked @endif/>
                        <i class="mdui-radio-icon"></i>
                        {{__('user.female')}}
                    </label>

                    <label class="mdui-switch mdui-m-x-2">
                        <input type="checkbox" name="sex_open" @if($user->info->sex_open=='true') checked @endif/>
                        <i class="mdui-switch-icon"></i>
                        {{__('user.publicDisplay')}}
                    </label>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">{{__('user.motto')}}</label>
                    <input class="mdui-textfield-input" name="motto" type="text" value="{{$user->info->motto}}"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label short-textfield">
                    <label class="mdui-textfield-label">{{__('user.wechatId')}}</label>
                    <input class="mdui-textfield-input" name="wechat" type="text" value="{{$user->info->wechat}}"/>
                    <label class="mdui-switch edit-info-dialog-right-select">
                        <input type="checkbox" name="wechat_open" @if($user->info->wechat_open=='true') checked @endif/>
                        <i class="mdui-switch-icon"></i>
                        {{__('user.publicDisplay')}}
                    </label>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">{{__('user.nation')}}</label>
                    <input class="mdui-textfield-input" name="nation" name="editUserInfoNation" type="text" value="{{$user->info->nation}}"/>
                    <label class="mdui-switch edit-info-dialog-right-select">
                        <input type="checkbox" name="nation_open" @if($user->info->nation_open=='true') checked @endif/>
                        <i class="mdui-switch-icon"></i>
                        {{__('user.publicDisplay')}}
                    </label>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">{{__('user.livingCity')}}</label>
                    <input class="mdui-textfield-input" name="living_city" type="text" value="{{$user->info->living_city}}"/>
                    <label class="mdui-switch edit-info-dialog-right-select">
                        <input type="checkbox" name="living_city_open" @if($user->info->living_city_open=='true') checked @endif/>
                        <i class="mdui-switch-icon"></i>
                        {{__('user.publicDisplay')}}
                    </label>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">{{__('user.engagedIn')}}</label>
                    <input class="mdui-textfield-input" name="engaged_in" type="text" value="{{$user->info->engaged_in}}"/>
                    <label class="mdui-switch edit-info-dialog-right-select">
                        <input type="checkbox" name="engaged_in_open" @if($user->info->engaged_in_open=='true') checked @endif/>
                        <i class="mdui-switch-icon"></i>
                        {{__('user.publicDisplay')}}
                    </label>
                </div>
            </div>
        </div>

        <div class="mdui-divider" style="margin-top: 50px"></div>
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">edit</i>{{__('user.confirmUpdate')}}</button>
        <a href="{{route('adminShowUsersList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('user.backToUsersList')}}</a>
        <div class="mdui-divider" style="margin-bottom: 200px"></div>

    </form>


@endsection