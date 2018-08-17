<div class="mdui-card user-center-cover userCover" style="background-image: url('{{$user->info->cover_bg_url}}');">
    @if($userIsMe)
        <div class="cover-upload">
            <label for="coverUploadInput">
                <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" title="点击上传封面">
                    <i class="mdui-icon material-icons">photo_camera</i>
                </a>
            </label>
            <input class="mdui-hidden" id="coverUploadInput" type="file" onchange="handleCoverUpdate(this,'userCover')" accept="image/jpeg,image/png">
        </div>
    @endif
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
        <div class="username-cover">{{$user->name}}</div>
        <div class="meta">
            @if($user->info->motto)
                <a class="headline">{{$user->info->motto}}</a>
            @else
                <a class="headline">此用户还未添加一句话介绍</a>
            @endif

        </div>
        @if($userIsMe)
            <a onclick="openEditUserInfoDialog()" class="right-btn mdui-btn mdui-btn-raised">修改个人资料</a>
        @else
            @if(Auth::check() && $user->isFollowedBy(Auth::user()))
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user->id}}',this,'pc-followerCount')" class="right-btn mdui-btn mdui-color-pink-accent mdui-btn-raised">
                    <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87d;</i>
                    <span>已关注</span>
                </a>
            @else
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user->id}}',this,'pc-followerCount')" class="right-btn mdui-btn mdui-text-color-pink-accent mdui-btn-raised">
                    <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87e;</i>
                    <span>关注</span>
                </a>
            @endif

        @endif
    </div>
</div>