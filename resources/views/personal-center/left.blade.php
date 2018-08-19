
<div class="mdui-panel mdui-panel-gapless mdui-hidden-md-up mdui-m-b-1" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">查看个人资料</div>
            <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-panel-item-body">
            <div class="side-card-content">
                @if($user->info->sex&&$user->info->sex_open=="true")
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
                @if($user->info->wechat&&$user->info->wechat_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            微信号
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->wechat}}
                        </div>
                    </div>
                @endif
                @if($user->info->nation&&$user->info->nation_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            国家
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->nation}}
                        </div>
                    </div>
                @endif
                @if($user->info->living_city&&$user->info->living_city_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            现居城市
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->living_city}}
                        </div>
                    </div>
                @endif
                @if($user->info->engaged_in&&$user->info->engaged_in_open=="true")
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
    </div>
</div>
@include('admin.layout.msg')
@if($userIsMe && $user->info->help_tip_open)
    @include('personal-center.help-update-info')
@endif
<div class="mdui-card mdui-hidden-md-up">
    <div class="right-focus-info">
        <a onclick="handleShowFollowingsDialog('{{route('userGetFollowings')}}','{{$user->id}}')" class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">正在关注</div>
                <strong class="right-focus-info-item-value">{{$followingsCount}}</strong>
            </div>
        </a>
        <a onclick="handleShowFollowersDialog('{{route('userGetFollowers')}}','{{$user->id}}')" class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">关注者</div>
                <strong class="right-focus-info-item-value pc-followerCount">{{$followersCount}}</strong>
            </div>
        </a>
    </div>
</div>
<div class="mdui-card">
    @if($userIsMe)
        <div class="mdui-tab part-divider-tab" mdui-tab>
            <a mdui-tooltip="{content: '查看我的动态', position: 'top'}" onclick="jumpTo('?view=activities')" href="#" class="mdui-ripple @if($view =='activities') mdui-tab-active  @endif">我的动态</a>
            <a mdui-tooltip="{content: '查看我发表的社区话题', position: 'top'}" onclick="jumpTo('?view=topics')" href="#" class="mdui-ripple @if($view =='topics') mdui-tab-active  @endif">社区话题</a>
            <a mdui-tooltip="{content: '查看我最近发表的评论', position: 'top'}" onclick="jumpTo('?view=replies')" href="#" class="mdui-ripple @if($view =='replies') mdui-tab-active  @endif">最近评论</a>
            <a mdui-tooltip="{content: '查看我赞同的内容', position: 'top'}" onclick="jumpTo('?view=voted')" href="#" class="mdui-ripple @if($view =='voted') mdui-tab-active  @endif">赞同内容</a>

        </div>
    @else
        <div class="mdui-tab part-divider-tab" mdui-tab>
            <a mdui-tooltip="{content: '查看此用户的动态', position: 'top'}" onclick="jumpTo('?view=activities')" href="#" class="mdui-ripple @if($view =='activities') mdui-tab-active  @endif">用户动态</a>
            <a mdui-tooltip="{content: '查看此用户发表的社区话题', position: 'top'}" onclick="jumpTo('?view=topics')" href="#" class="mdui-ripple @if($view =='topics') mdui-tab-active  @endif">社区话题</a>
            <a mdui-tooltip="{content: '查看此用户最近发表的评论', position: 'top'}" onclick="jumpTo('?view=replies')" href="#" class="mdui-ripple @if($view =='replies') mdui-tab-active  @endif">最近评论</a>
            <a mdui-tooltip="{content: '查看此用户赞同的内容', position: 'top'}" onclick="jumpTo('?view=voted')" href="#" class="mdui-ripple @if($view =='voted') mdui-tab-active  @endif">赞同内容</a>
        </div>
    @endif
    @switch($view)
        @case('topics')
            <div class="community-topic-list">
                @include('personal-center.left-topic-data')
                <div  id="PersonalCenterListData"></div>
            </div>
        @break
        @case('replies')
            <div class="community-topic-list">
                @include('personal-center.left-reply-data')
                <div  id="PersonalCenterListData"></div>
            </div>
        @break
        @case('voted')
            <div class="community-topic-list">
                @include('personal-center.left-voted-data')
                <div id="PersonalCenterListData"></div>
            </div>
        @break
        @default
            @include('personal-center.left-activity-data')
            <div  id="PersonalCenterListData"></div>
    @endswitch

    <div id="PersonalCenterListLoadingTip" class="mdui-m-y-2" style="display:none">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
        <span class="loading-tip-text">正在加载更多</span>
    </div>
    <div id="PersonalCenterListLoadingFailed" class="animated fadeIn faster" style="display:none">
        <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
        <span class="loading-tip-text">没有更多了</span>
    </div>


</div>