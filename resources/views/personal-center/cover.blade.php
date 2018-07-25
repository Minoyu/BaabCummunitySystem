<div class="mdui-card user-center-cover userCover" style="background-image: url('{{$user->info->cover_bg_url}}');">
    <div class="cover-upload">
        <label for="coverUploadInput">
            <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" title="点击上传封面">
                <i class="mdui-icon material-icons">photo_camera</i>
            </a>
        </label>
        <input class="mdui-hidden" id="coverUploadInput" type="file" onchange="handleCoverUpdate(this,'userCover')" accept="image/jpeg,image/png">
    </div>
    <div class="gradient mdui-card-media-covered mdui-card-media-covered-gradient"></div>
    <div class="user-center-cover-info">
        <div class="avatar-box">
            @if($userIsMe)
                <div class="avatar-upload">
                    <label for="personalCenterAvatarUploadInput">
                        <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" title="点击上传头像">
                            <i class="mdui-icon material-icons">photo_camera</i>
                        </a>
                    </label>
                    <input class="mdui-hidden" id="personalCenterAvatarUploadInput" type="file" onchange="handleAvatarUpdate(this,'userAvatar')" accept="image/jpeg,image/png">
                </div>
            @endif
            <img src="{{$user->info->avatar_url}}" class="avatar mdui-hoverable userAvatar">
        </div>
        <div class="username">{{$user->name}}</div>
        <div class="meta">
            <a href="" class="headline">{{$user->info->motto}}</a>
        </div>
        @if($userIsMe)
            <a onclick="openEditUserInfoDialog()" class="right-btn mdui-btn mdui-btn-raised">修改个人资料</a>
        @else
            <a class="right-btn mdui-btn mdui-btn-raised">关注</a>
        @endif
    </div>
</div>