<div class="mdui-card user-center-cover"
     @if($user->info->cover_bg_url)
        style="background-image: url('{{$user->info->cover_bg_url}}');"
     @else
        style="background-image: url('/imgs/cover_default_bg.webp');"
    @endif
>
    <div class="cover-upload">
        <label for="coverUploadInput">
            <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" title="点击上传封面">
                <i class="mdui-icon material-icons">photo_camera</i>
            </a>
        </label>
        <input class="mdui-hidden" id="coverUploadInput" type="file" title=" "  accept="image/jpeg,image/png">
    </div>
    <div class="gradient mdui-card-media-covered mdui-card-media-covered-gradient"></div>
    <div class="user-center-cover-info">
        <div class="avatar-box">
            <div class="avatar-upload">
                <label for="avatarUploadInput">
                    <a class="mdui-btn mdui-btn-icon mdui-ripple upload-btn" title="点击上传头像">
                        <i class="mdui-icon material-icons">photo_camera</i>
                    </a>
                </label>
                <input class="mdui-hidden" id="avatarUploadInput" type="file" title=" " accept="image/jpeg,image/png">
            </div>
            <img src="{{$user->info->avatar_url}}" class="avatar mdui-hoverable">
        </div>
        <div class="username">{{$user->name}}</div>
        <div class="meta">
            <a href="" class="headline">{{$user->info->motto}}</a>
        </div>
        <a onclick="openEditUserInfoDialog()" class="right-btn mdui-btn mdui-btn-raised">修改个人资料</a>
    </div>
</div>