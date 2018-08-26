<div class="mdui-card  mdui-m-t-1 mdui-hoverable">
    <div class="side-card-header">
        <div class="side-card-header-text">
            {{__('user.personalInfo')}}
        </div>
    </div>
    <div class="side-card-content">
        @if($user->info->sex&&$user->info->sex_open=="true")
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">{{__('user.sex')}}</div>
                @if($user->info->sex)
                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-male mdui-text-color-blue"></i></div>
                @else
                    <div class="side-card-content-item-c"><i class="mdui-icon ion-md-female mdui-text-color-red"></i></div>
                @endif
            </div>
        @endif

        <div class="side-card-content-item">
            <div class="side-card-content-item-h">
                {{__('user.motto')}}
            </div>
            <div class="side-card-content-item-c">
                @if($user->info->motto)
                    {{$user->info->motto}}
                @else
                    {{__('user.noMotto')}}
                @endif
            </div>
        </div>
        @if($user->info->wechat&&$user->info->wechat_open=="true")
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    {{__('user.wechatId')}}
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->wechat}}
                </div>
            </div>
        @endif
        @if($user->info->nation&&$user->info->nation_open=="true")
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    {{__('user.nation')}}
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->nation}}
                </div>
            </div>
        @endif
        @if($user->info->living_city&&$user->info->living_city_open=="true")
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    {{__('user.livingCity')}}
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->living_city}}
                </div>
            </div>
        @endif
        @if($user->info->engaged_in&&$user->info->engaged_in_open=="true")
            <div class="side-card-content-item">
                <div class="side-card-content-item-h">
                    {{__('user.engagedIn')}}
                </div>
                <div class="side-card-content-item-c">
                    {{$user->info->engaged_in}}
                </div>
            </div>
        @endif

    </div>
</div>