<div class="mdui-dialog edit-user-info-dialog" id="edit-user-info-dialog">
    <div class="mdui-dialog-title">
        <a class="mdui-btn mdui-btn-icon mdui-text-color-indigo" style="margin-top: -5px" mdui-dialog-close>
            <i class="mdui-icon material-icons">chevron_left</i>
        </a>
        {{__('user.editProfile')}}
    </div>
    <div class="mdui-dialog-content">
        <div class="avatar-box">
            <div class="avatar-upload">
                <label for="editInfoDialogAvatarUploadInput">
                    <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" mdui-tooltip="{content: '{{__('user.uploadCoverTip')}}', position: 'top'}">
                        <i class="mdui-icon material-icons">photo_camera</i>
                    </a>
                </label>
                <input class="mdui-hidden" id="editInfoDialogAvatarUploadInput" type="file" onchange="handleAvatarUpdate(this,'userAvatar')" accept="image/jpeg,image/png">
            </div>
            <img src="{{$user->info->avatar_url}}" class="avatar mdui-hoverable userAvatar">
        </div>
        <div class="user-info-box">
            <div id="editUserInfoNameTextField" class="mdui-textfield mdui-textfield-floating-label short-textfield mdui-p-t-0">
                <label class="mdui-textfield-label">{{__('user.username')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoName" type="text" value="{{$user->name}}" required/>
                <div class="mdui-textfield-error">{{__('auth.nameEmpty')}}</div>
            </div>
            <div class="mdui-textfield short-textfield">
                <label class="mdui-textfield-label">{{__('user.sex')}}</label>
                        <label class="mdui-radio mdui-m-x-2">
                            <input type="radio" name="editUserInfoSex" value="male" @if($user->info->sex=='male') checked @endif/>
                            <i class="mdui-radio-icon"></i>
                            {{__('user.male')}}
                        </label>

                        <label class="mdui-radio mdui-m-x-2">
                            <input type="radio" name="editUserInfoSex" value="female" @if($user->info->sex=='female') checked @endif/>
                            <i class="mdui-radio-icon"></i>
                            {{__('user.female')}}
                        </label>

                        <label class="mdui-switch mdui-m-x-2">
                            <input type="checkbox" name="editUserInfoSexOpen" @if($user->info->sex_open=='true') checked @endif/>
                            <i class="mdui-switch-icon"></i>
                            {{__('user.publicDisplay')}}
                        </label>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">{{__('user.motto')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoMotto" type="text" value="{{$user->info->motto}}"/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label short-textfield">
                <label class="mdui-textfield-label">{{__('user.wechatId')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoWechat" type="text" value="{{$user->info->wechat}}"/>
                <label class="mdui-switch edit-info-dialog-right-select">
                    <input type="checkbox" name="editUserInfoWechatOpen" @if($user->info->wechat_open=='true') checked @endif/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">{{__('user.nation')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoNation" name="editUserInfoNation" type="text" value="{{$user->info->nation}}"/>
                <label class="mdui-switch edit-info-dialog-right-select">
                    <input type="checkbox" name="editUserInfoNationOpen" @if($user->info->nation_open=='true') checked @endif/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">{{__('user.livingCity')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoLivingCity" type="text" value="{{$user->info->living_city}}"/>
                <label class="mdui-switch edit-info-dialog-right-select">
                    <input type="checkbox" name="editUserInfoLivingCityOpen" @if($user->info->living_city_open=='true') checked @endif/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">{{__('user.engagedIn')}}</label>
                <input class="mdui-textfield-input" name="editUserInfoEngagedIn" type="text" value="{{$user->info->engaged_in}}"/>
                <label class="mdui-switch edit-info-dialog-right-select">
                    <input type="checkbox" name="editUserInfoEngagedInOpen" @if($user->info->engaged_in_open=='true') checked @endif/>
                    <i class="mdui-switch-icon"></i>
                    {{__('user.publicDisplay')}}
                </label>
            </div>
        </div>
    </div>
    <div class="mdui-dialog-actions">
        <button class="mdui-btn mdui-ripple" mdui-dialog-close>{{__('index.back')}}</button>
        <a onclick="editUserInfoDialogSubmit()" class="mdui-btn mdui-ripple">OK</a>
    </div>
</div>