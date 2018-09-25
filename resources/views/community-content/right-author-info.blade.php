<div class="mdui-card mdui-hoverable side-card mdui-m-t-2">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            {{__('user.authInfo')}}
        </div>
    </div>
    <div class="side-card-content">
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <img class="side-card-user-avatar mdui-hoverable" src="{{$topic->user->info->avatar_url}}">
        </a>
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <div class="side-card-user-name">
                {{$topic->user->name}}
            </div>
        </a>

        <div class="side-card-user-motto">
            @foreach($topic->user->roles as $role)
                @switch($role->name)
                    @case('Founder')
                    <span class="layui-badge">{{$role->name}}</span>
                    @break
                    @case('Maintainer')
                    <span class="layui-badge layui-bg-blue">{{$role->name}}</span>
                    @break
                    @case('BanedUser')
                    <span class="layui-badge layui-bg-black">Banned</span>
                    @break
                @endswitch
            @endforeach
            @if($topic->user->info->motto)
                {{$topic->user->info->motto}}
            @endif
        </div>
        <div class="mdui-panel mdui-panel-gapless mdui-m-b-1 side-card-user-info" mdui-panel>
            <div class="mdui-panel-item">
                <div class="mdui-panel-item-header">
                    <div class="mdui-panel-item-title" style="width: auto">{{__('user.viewPersonalInfo')}}</div>
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body">
                    <div class="side-card-content">
                        @if($topic->user->info->sex&&$topic->user->info->sex_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">{{__('user.sex')}}</div>
                                @if($topic->user->info->sex)
                                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-male mdui-text-color-blue"></i></div>
                                @else
                                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-female mdui-text-color-red"></i></div>
                                @endif
                            </div>
                        @endif
                        @if($topic->user->info->wechat&&$topic->user->info->wechat_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    {{__('user.wechatId')}}
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->wechat}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->nation&&$topic->user->info->nation_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    {{__('user.nation')}}
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->nation}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->living_city&&$topic->user->info->living_city_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    {{__('user.livingCity')}}
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->living_city}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->engaged_in&&$topic->user->info->engaged_in_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    {{__('user.engagedIn')}}
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->engaged_in}}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @if(Auth::id() != $topic->user->id)
            @if(Auth::check() && $topic->user->isFollowedBy(Auth::user()))
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$topic->user->id}}',this)" class="mdui-btn mdui-color-pink-accent mdui-center side-card-user-btn">
                    <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87d;</i>
                    <span>{{__('user.followed')}}</span>
                </a>
            @else
                <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$topic->user->id}}',this)" class="mdui-btn mdui-text-color-pink-accent mdui-center side-card-user-btn">
                    <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87e;</i>
                    <span>{{__('user.follow')}}</span>
                </a>
            @endif
        @endif
        <a href="{{route('showPersonalCenter',$topic->user->id)}}" class="mdui-btn mdui-color-grey-100 mdui-ripple mdui-center mdui-m-t-1 side-card-user-btn mdui-hoverable">
            <i class="mdui-icon material-icons">account_circle</i>
            {{__('index.personalCenter')}}
        </a>
    </div>
</div>