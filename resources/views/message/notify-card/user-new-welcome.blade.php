<div class="mdui-card notify-card mdui-m-y-2 mdui-hoverable" style="border-radius: 8px">
    <!-- 卡片的标题和副标题 -->
    <div class="mdui-card-primary mdui-p-y-1">
        <div class="mdui-card-primary-title">
            <i class="mdui-icon material-icons mdui-text-color-pink-accent" style="font-size: 20px;padding-bottom: 5px;">favorite</i>
            {{__('message.welcomeTitle')}} {{Auth::user()->name}}
        </div>
        <div class="mdui-card-primary-subtitle">
            @if(!$notification['isRead'])
                <span class="layui-badge">NEW</span>
            @endif
            <i class="mdui-icon material-icons" style="font-size: 16px">access_time</i>
            {{$notification['created_at']->diffForHumans()}}
        </div>
    </div>

    <div class="mdui-card-content mdui-p-y-1">
        Thank you for joining Baab.Club and becoming one of us.<br>
        Here are some <a href="{{$notification['welcomeTopicLink']}}"><i>tips for BaabClub</i></a> . we hope you can read it.
    </div>

    <!-- 卡片的按钮 -->
    <div class="mdui-card-actions mdui-p-y-0">
        <a href="{{$notification['welcomeTopicLink']}}" class="mdui-btn mdui-btn-dense mdui-float-right mdui-ripple mdui-color-blue-400 mdui-text-color-white">
            {{__('admin.view')}}
            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>
        </a>
    </div>
</div>