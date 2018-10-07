<div class="mdui-card notify-card mdui-m-y-2 mdui-hoverable" style="border-radius: 8px">
    <!-- 卡片的标题和副标题 -->
    <div class="mdui-card-primary mdui-p-y-1">
        <div class="mdui-card-primary-title">
            <i class="mdui-icon material-icons mdui-text-color-pink-accent" style="font-size: 20px;padding-bottom: 5px;">favorite</i>
            {{__('message.userFollowedTitle')}}
        </div>
        <div class="mdui-card-primary-subtitle">
            @if(!$notification['isRead'])
                <span class="layui-badge">NEW</span>
            @endif
            <i class="mdui-icon material-icons" style="font-size: 16px">access_time</i>
            {{$notification['created_at']->diffForHumans()}}
        </div>
    </div>

    <div class="mdui-card-header mdui-color-grey-100 mdui-p-y-1">
        <a href="{{route('showPersonalCenter',$notification['user']->id)}}">
            <img class="mdui-card-header-avatar mdui-hoverable" src="{{$notification['user']->info->avatar_url}}"/>
        </a>
        <div class="mdui-card-header-title">
            {{__('index.from')}}
            <a href="{{route('showPersonalCenter',$notification['user']->id)}}">
                {{$notification['user']->name}}
            </a>
        </div>
        <div class="mdui-card-header-subtitle">
            @if($notification['user']->info->motto)
                {{$notification['user']->info->motto}}
            @else
                {{__('user.noMotto')}}
            @endif
        </div>
        {{--<button class="follow-btn mdui-btn mdui-btn-dense mdui-btn-icon"><i class="mdui-icon material-icons">favorite</i></button>--}}
    </div>

    <!-- 卡片的按钮 -->
    <div class="mdui-card-actions mdui-p-y-0">
        @if((Auth::check() && $notification['user']->id != Auth::id()) || !Auth::check())
            @if( Auth::check() && $notification['user']->isFollowedBy(Auth::user()))
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$notification['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-color-pink-accent mdui-float-right">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe87d;</i>
                    <span>{{__('user.followed')}}</span>
                </a>
            @else
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$notification['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-text-color-pink-accent mdui-float-right">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe87e;</i>
                    <span>{{__('user.follow')}}</span>
                </a>
            @endif
        @endif
        <button onclick="showCreateMessageDialog([{{$notification['user']->id}}])" class="mdui-btn mdui-btn-dense mdui-ripple mdui-float-right mdui-text-color-blue">
            <i class="mdui-icon material-icons mdui-icon-left">email</i>
            <span>{{__('message.message')}}</span>
        </button>
    </div>
</div>