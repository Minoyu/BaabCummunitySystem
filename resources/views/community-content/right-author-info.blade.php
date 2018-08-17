<div class="mdui-card mdui-hoverable side-card">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            作者信息
        </div>
    </div>
    <div class="side-card-content">
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <img class="side-card-user-avatar mdui-hoverable" src="{{$topic->user->info->avatar_url}}">
        </a>
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <div class="side-card-user-name">{{$topic->user->name}}</div>
        </a>

        <div class="side-card-user-motto">
            @if($topic->user->info->motto)
                {{$topic->user->info->motto}}
            @else
                此用户还未添加一句话介绍
            @endif
        </div>
        <div class="mdui-panel mdui-panel-gapless mdui-m-b-1 side-card-user-info" mdui-panel>
            <div class="mdui-panel-item">
                <div class="mdui-panel-item-header">
                    <div class="mdui-panel-item-title" style="width: auto">查看个人资料</div>
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body">
                    <div class="side-card-content">
                        @if($topic->user->info->sex&&$topic->user->info->sex_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">性别</div>
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
                                    微信号
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->wechat}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->nation&&$topic->user->info->nation_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    国家
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->nation}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->living_city&&$topic->user->info->living_city_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    现居城市
                                </div>
                                <div class="side-card-content-item-c">
                                    {{$topic->user->info->living_city}}
                                </div>
                            </div>
                        @endif
                        @if($topic->user->info->engaged_in&&$topic->user->info->engaged_in_open=="true")
                            <div class="side-card-content-item">
                                <div class="side-card-content-item-h">
                                    职业/从事行业
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
        @if(Auth::check() && $topic->user->isFollowedBy(Auth::user()))
            <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$topic->user->id}}',this)" class="mdui-btn mdui-color-pink-accent mdui-btn-raised mdui-center side-card-user-btn">
                <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87d;</i>
                <span>已关注</span>
            </a>
        @else
            <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$topic->user->id}}',this)" class="mdui-btn mdui-text-color-pink-accent mdui-btn-raised mdui-center side-card-user-btn">
                <i class="mdui-icon material-icons" style="margin-top: -2px;font-size: 20px;">&#xe87e;</i>
                <span>关注</span>
            </a>
        @endif
        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-center mdui-m-t-1 side-card-user-btn">
            <i class="mdui-icon material-icons">&#xe0be;</i>
            发私信
        </button>
        </div>
    </div>
</div>