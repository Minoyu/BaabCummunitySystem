<div class="mdui-card notify-card mdui-m-y-2 mdui-hoverable" style="border-radius: 8px">
    <!-- 卡片的标题和副标题 -->
    <div class="mdui-card-primary mdui-p-y-1">
        <div class="mdui-card-primary-title">
            <i class="mdui-icon material-icons mdui-text-color-green" style="padding-bottom: 3px;">reply</i>
            {{__('message.commentRepliedTitle')}}
        </div>
        <div class="mdui-card-primary-subtitle">
            @if(!$notification['isRead'])
                <span class="layui-badge">NEW</span>
            @endif
            <i class="mdui-icon material-icons" style="font-size: 16px">access_time</i>
            {{$notification['created_at']->diffForHumans()}}
            <br>

            {{__('message.underNews')}}
            <i>
                <a href="{{route('showNewsContent',$notification['news']->id)}}">
                    {{$notification['news']->title}}
                </a>
            </i>
        </div>
    </div>

    <!-- 卡片的内容 -->
    <div class="mdui-card-content mdui-p-y-1">
        <div class="photo-gallery">
            {!! $notification['reply']->content !!}
        </div>
    </div>

    <div class="mdui-card-header mdui-color-grey-100 mdui-p-y-1">
        <a href="{{route('showPersonalCenter',$notification['replier']->id)}}">
            <img class="mdui-card-header-avatar mdui-hoverable" src="{{$notification['replier']->info->avatar_url}}"/>
        </a>
        <div class="mdui-card-header-title">
            {{__('index.from')}}
            <a href="{{route('showPersonalCenter',$notification['replier']->id)}}">
                {{$notification['replier']->name}}
            </a>
        </div>
        <div class="mdui-card-header-subtitle">
            @if($notification['replier']->info->motto)
                {{$notification['replier']->info->motto}}
            @else
                {{__('user.noMotto')}}
            @endif
        </div>
        {{--<button class="follow-btn mdui-btn mdui-btn-dense mdui-btn-icon"><i class="mdui-icon material-icons">favorite</i></button>--}}
    </div>

    <!-- 卡片的按钮 -->
    <div class="mdui-card-actions mdui-p-y-0">
        <a href="{{route('showNewsContent',$notification['news']->id)}}#reply-{{$notification['news']->id}}" class="mdui-btn mdui-btn-dense mdui-float-right mdui-ripple mdui-color-blue-400 mdui-text-color-white">
            {{__('admin.view')}}
            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>
        </a>
        @if((Auth::check() && $notification['replier']->id != Auth::id()) || !Auth::check())
            @if( Auth::check() && $notification['replier']->isFollowedBy(Auth::user()))
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$notification['replier']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-color-pink-accent mdui-float-right">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe87d;</i>
                    <span>{{__('user.followed')}}</span>
                </a>
            @else
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$notification['replier']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-text-color-pink-accent mdui-float-right">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe87e;</i>
                    <span>{{__('user.follow')}}</span>
                </a>
            @endif
        @endif
        <button onclick="showCreateMessageDialog([{{$notification['replier']->id}}])" class="mdui-btn mdui-btn-dense mdui-ripple mdui-float-right mdui-text-color-blue">
            <i class="mdui-icon material-icons mdui-icon-left">email</i>
            <span>{{__('message.message')}}</span>
        </button>
    </div>
</div>