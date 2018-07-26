<div class="mdui-card  mdui-m-t-1 mdui-hoverable">
    <div class="side-card-header">
        <div class="side-card-header-text">
            个人资料
        </div>
    </div>
    <div class="side-card-content">
        @if($user->info->sex&&$user->info->sex_open)
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">性别</div>
                @if($user->info->sex)
                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-male mdui-text-color-blue"></i></div>
                @else
                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-female mdui-text-color-red"></i></div>
                @endif
            </div>
        @endif

        <div class="side-card-content-item">
            <div class="side-card-content-item-h">
                一句话介绍
            </div>
            <div class="side-card-content-item-c">
                @if($user->info->motto)
                    {{$user->info->motto}}
                @else
                    此用户还未添加一句话介绍
                @endif
            </div>
        </div>
        @if($user->info->wechat&&$user->info->wechat_open)
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    微信号
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->wechat}}
                </div>
            </div>
        @endif
        @if($user->info->nation&&$user->info->nation_open)
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    国家
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->nation}}
                </div>
            </div>
        @endif
        @if($user->info->living_city&&$user->info->living_city_open)
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    现居城市
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->living_city}}
                </div>
            </div>
        @endif
        @if($user->info->engaged_in&&$user->info->engaged_in_open)
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    职业/从事行业
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->engaged_in}}
                </div>
            </div>
        @endif

    </div>
</div>